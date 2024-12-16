<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="widht=device-width, initial-scale=1.0">
        <title>Kalkulator analog dengan riwayat</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/boostrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="container mt-5">
    <div class="calculator bg-light">
        <div class="card">
            <div class="text-end mb-1">
                
        <label class="form-check-label me-0 col-form-label-sm">Tema</label>
        <div class="form-check form-switch d-inline-block">
            <input class="form-check-input" type="checkbox" id="themeToggle">
        </div>
    </div>
    <div class="card-header text-center bg-primary text-white">
        <h4>Kalkulator Analog</h4>
    </div>
    <div class="card-body">
        <form method="post">
             
    <input type="text" class="form-control mb-3 display" name="display" id="display" readonly 
    value="<?php echo isset($_POST['display']) ? $_POST['display'] : ''; ?>">

    
     <div class="row g-2 mb-3">
        <?php
        $butons = [
            ['7', '8', '9', '/'],
            ['4', '5', '6', '*'],
            ['1', '2', '3', '-'],
            ['0', 'C', '=', '+']
        ];
        foreach ($butons as $row) {
            foreach ($row as $btn) {
                $class = is_numeric($btn) ? 'btn-number' : ($btn === 'C' || $btn === '=' ? 'btn-clear' : 'btn-operator');
                echo '<div class="col-3">';
                echo '<buton type="submit" name="buton" value="' . $btn . '" class="btn ' . $class . ' w-100">' . $btn . '</buton>';
                 echo '</div>';
                }
            }
            ?>
            </div>
            <textarea class="form-control mb-3" name="history" rows="5" readonly><?php 
            echo isset($_POST['history']) ? $_POST['history'] : ''; 
            ?>
            </textarea>
            <buton type="submit" name="clear_history" class="btn btn-clear-history w-100">Clear History</buton>
            </form>
            <body>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $current = $_POST['display'] ?? '';
                    $buton = $_POST['buton'] ?? '';
                    $history = $_POST['history'] ?? '';
                    if (isset($_POST['clear_history'])) {
                        $history = '';
                    } elseif ($buton === 'C') {
                        $current = '';
                    } elseif ($buton === '=') {
                        try {
                            $result = eval("return $current;");
                            $history .= $current . ' = ' . $result . PHP_EOL;
                            $current = $result;
                        } catch (Exception $e) {
                            $current = 'Error';
                        }
                    } else {
                        $current .= $buton;
                    }
                    echo "<script>
                    document.getElementById('display').value = '$current';
                    document.getElementsByName('history')[0].value = `$history`;
                    </script>";
                }
                ?>
                <script src="htps://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                <script src="script.js"></script>
            </body>
        </html>