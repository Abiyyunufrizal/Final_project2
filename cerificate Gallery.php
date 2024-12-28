<?php
session_start();

// Database connection
$host = 'localhost';
$dbname = 'sertifikat_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Array template default
$default_templates = [
    [
        'id' => 1,
        'name' => 'Certificate Template 1',
        'image' => 'templates/template1.jpg',
        'category' => 'Achievement'
    ],
    [
        'id' => 2,
        'name' => 'Certificate Template 2',
        'image' => 'templates/template2.jpg',
        'category' => 'Appreciation'
    ],
    [
        'id' => 3,
        'name' => 'Certificate Template 3',
        'image' => 'templates/template3.jpg',
        'category' => 'Completion'
    ],
    [
        'id' => 4,
        'name' => 'Template A',
        'image' => 'templates/a.jpg',
        'category' => 'Custom'
    ],
    [
        'id' => 5,
        'name' => 'Template B',
        'image' => 'templates/b.jpg',
        'category' => 'Custom'
    ]
];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Designer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .template-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }
        
        .template-card {
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.2s;
            cursor: pointer;
        }
        
        .template-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .template-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .template-info {
            padding: 15px;
        }
        
        .design-area {
            background: #f8f9fa;
            min-height: 600px;
            border: 1px solid #ddd;
            margin-top: 20px;
            position: relative;
        }
        
        .text-element {
            position: absolute;
            cursor: move;
            padding: 5px;
            border: 1px dashed transparent;
        }
        
        .text-element:hover {
            border-color: #007bff;
        }
        
        .toolbar {
            background: white;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
        
        .preview-container {
            width: 100%;
            height: calc(100vh - 200px);
            overflow-y: auto;
            padding: 20px;
        }
        
        .template-preview {
            max-width: 100%;
            margin: auto;
            display: block;
        }
        
        .category-filter {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar dengan Template Gallery -->
            <div class="col-md-3 p-3 border-end vh-100 overflow-auto">
                <h4>Certificate Templates</h4>
                
                <!-- Category Filter -->
                <div class="category-filter">
                    <select class="form-select" id="category-select">
                        <option value="">All Categories</option>
                        <option value="Achievement">Achievement</option>
                        <option value="Appreciation">Appreciation</option>
                        <option value="Completion">Completion</option>
                        <option value="Custom">Custom</option>
                    </select>
                </div>
                
                <!-- Template Gallery -->
                <div class="template-gallery">
                    <?php foreach($default_templates as $template): ?>
                    <div class="template-card" data-category="<?php echo $template['category']; ?>"
                         onclick="selectTemplate('<?php echo $template['image']; ?>')">
                        <img src="<?php echo $template['image']; ?>" class="template-image" alt="<?php echo $template['name']; ?>">
                        <div class="template-info">
                            <h5 class="mb-2"><?php echo $template['name']; ?></h5>
                            <span class="badge bg-primary"><?php echo $template['category']; ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Main Design Area -->
            <div class="col-md-9">
                <div class="toolbar">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="text-content" placeholder="Enter text">
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" id="font-family">
                                <option value="Arial">Arial</option>
                                <option value="Times New Roman">Times New Roman</option>
                                <option value="Helvetica">Helvetica</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control" id="font-size" value="16" min="8" max="72">
                        </div>
                        <div class="col-md-2">
                            <input type="color" class="form-control" id="font-color" value="#000000">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary" onclick="addTextElement()">Add Text</button>
                            <button class="btn btn-success" onclick="generatePDF()">Generate PDF</button>
                        </div>
                    </div>
                </div>
                
                <div class="preview-container">
                    <div class="design-area" id="certificate-canvas">
                        <!-- Template preview will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function selectTemplate(templateUrl) {
            $('#certificate-canvas').html(`
                <img src="${templateUrl}" class="template-preview" alt="Selected template">
            `);
            initializeDraggable();
        }

        function addTextElement() {
            const text = $('#text-content').val();
            const fontFamily = $('#font-family').val();
            const fontSize = $('#font-size').val();
            const color = $('#font-color').val();
            
            if(text) {
                const element = $('<div>', {
                    class: 'text-element',
                    text: text,
                    css: {
                        'font-family': fontFamily,
                        'font-size': fontSize + 'px',
                        'color': color
                    }
                });
                
                $('#certificate-canvas').append(element);
                initializeDraggable();
            }
        }

        function initializeDraggable() {
            $('.text-element').draggable({
                containment: '#certificate-canvas',
                stop: function(event, ui) {
                    // Save position if needed
                    console.log(ui.position);
                }
            });
        }

        // Category filter
        $('#category-select').change(function() {
            const category = $(this).val();
            if(category) {
                $('.template-card').hide();
                $(`.template-card[data-category="${category}"]`).show();
            } else {
                $('.template-card').show();
            }
        });

        function generatePDF() {
            // Add PDF generation logic here
            alert('PDF generation will be implemented here');
        }
    </script>
</body>
</html>
