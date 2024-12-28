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

// Array template default dengan path gambar yang benar
$default_templates = [
    [
        'id' => 1,
        'name' => 'Certificate Template 1',
        'image' => 'assets/images/template1.jpg',
        'category' => 'Achievement'
    ],
    [
        'id' => 2,
        'name' => 'Certificate Template 2',
        'image' => 'assets/images/template2.jpg',
        'category' => 'Appreciation'
    ],
    [
        'id' => 3,
        'name' => 'Certificate Template 3',
        'image' => 'assets/images/template3.jpg',
        'category' => 'Completion'
    ]
];

// Fungsi untuk memproses form sertifikat
function processCertificateForm() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $recipientName = $_POST['recipient_name'] ?? '';
        $certificateDate = $_POST['certificate_date'] ?? '';
        $achievement = $_POST['achievement'] ?? '';
        
        return [
            'recipient_name' => $recipientName,
            'certificate_date' => $certificateDate,
            'achievement' => $achievement
        ];
    }
    return null;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Designer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
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
        /* assets/css/style.css */
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

.preview-container {
    width: 100%;
    height: calc(100vh - 250px);
    overflow-y: auto;
    padding: 20px;
}

.template-preview {
    max-width: 100%;
    height: auto;
    margin: auto;
    display: block;
    object-fit: contain;
}

.certificate-text {
    text-align: center;
    pointer-events: none;
    z-index: 100;
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
                <!-- Certificate Form -->
                <div class="certificate-form mb-3 p-3">
                    <form id="certificateForm" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="recipient_name" id="recipient_name" placeholder="Nama Penerima" required>
                            </div>
                            <div class="col-md-4">
                                <input type="date" class="form-control" name="certificate_date" id="certificate_date" required>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="achievement" id="achievement" placeholder="Pencapaian" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Generate Certificate</button>
                    </form>
                </div>

                <!-- Preview Area -->
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
    <script src="assets/js/script.js"></script>
    
    <script>
 // assets/js/script.js
function selectTemplate(templateUrl) {
    console.log("Selected template:", templateUrl);
    
    const img = new Image();
    img.onload = function() {
        $('#certificate-canvas').html('').append($(this).addClass('template-preview'));
        initializeDraggable();
    };
    img.onerror = function() {
        console.error("Failed to load template:", templateUrl);
        alert("Failed to load template image");
    };
    img.src = templateUrl;
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
            console.log(ui.position);
        }
    });
}

// Form handling
document.getElementById('certificateForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const recipientName = document.getElementById('recipient_name').value;
    const certificateDate = document.getElementById('certificate_date').value;
    const achievement = document.getElementById('achievement').value;
    
    const certificateCanvas = document.getElementById('certificate-canvas');
    
    // Clear existing texts
    const existingTexts = certificateCanvas.querySelectorAll('.certificate-text');
    existingTexts.forEach(text => text.remove());
    
    // Add recipient name
    addTextToPosition(recipientName, '50%', '40%', '24px');
    
    // Add date
    const formattedDate = new Date(certificateDate).toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });
    addTextToPosition(formattedDate, '70%', '80%', '16px');
    
    // Add achievement if needed
    addTextToPosition(achievement, '50%', '50%', '18px');
});

function addTextToPosition(text, x, y, fontSize) {
    const textElement = document.createElement('div');
    textElement.className = 'certificate-text text-element';
    textElement.style.position = 'absolute';
    textElement.style.left = x;
    textElement.style.top = y;
    textElement.style.transform = 'translate(-50%, -50%)';
    textElement.style.fontSize = fontSize;
    textElement.style.fontFamily = 'Arial, sans-serif';
    textElement.textContent = text;
    
    document.getElementById('certificate-canvas').appendChild(textElement);
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
    </script>
</body>
</html>