<?php
    http_response_code(500);
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>500 Error Debug</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM' crossorigin='anonymous'>
    <link href='https://cdn.jsdelivr.net/gh/K-cermak/Enplated-Framework@enp-v3/enp-data/darkmode.min.css' rel='stylesheet'>
</head>
<body>
    <div class='container'>
        <div class='row'>
            <div class='col-12'>
                <h1 class='text-center mt-4 text-danger d-flex justify-content-center align-items-center'>
                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bug" viewBox="0 0 16 16">
                        <path d="M4.355.522a.5.5 0 0 1 .623.333l.291.956A5 5 0 0 1 8 1c1.007 0 1.946.298 2.731.811l.29-.956a.5.5 0 1 1 .957.29l-.41 1.352A5 5 0 0 1 13 6h.5a.5.5 0 0 0 .5-.5V5a.5.5 0 0 1 1 0v.5A1.5 1.5 0 0 1 13.5 7H13v1h1.5a.5.5 0 0 1 0 1H13v1h.5a1.5 1.5 0 0 1 1.5 1.5v.5a.5.5 0 1 1-1 0v-.5a.5.5 0 0 0-.5-.5H13a5 5 0 0 1-10 0h-.5a.5.5 0 0 0-.5.5v.5a.5.5 0 1 1-1 0v-.5A1.5 1.5 0 0 1 2.5 10H3V9H1.5a.5.5 0 0 1 0-1H3V7h-.5A1.5 1.5 0 0 1 1 5.5V5a.5.5 0 0 1 1 0v.5a.5.5 0 0 0 .5.5H3c0-1.364.547-2.601 1.432-3.503l-.41-1.352a.5.5 0 0 1 .333-.623M4 7v4a4 4 0 0 0 3.5 3.97V7zm4.5 0v7.97A4 4 0 0 0 12 11V7zM12 6a4 4 0 0 0-1.334-2.982A3.98 3.98 0 0 0 8 2a3.98 3.98 0 0 0-2.667 1.018A4 4 0 0 0 4 6z"/>
                    </svg>
                    Error 500 occurred
                </h1>
                <p class='text-center lead text-danger'>Enplated MVC Error Debug v1.0</p>
                <p class="text-center text-muted">Time: <?php echo date('Y-m-d H:i:s'); ?></p>
                <div class='row'>
                    <div class='col-12'>
                        <hr>
                        <h2 class="text-warning d-flex align-items-center">
                            <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                            </svg>    
                            Debug info:
                        </h2>
                        <hr>
                        <div class='row ms-3'>
                            <div class='col-12'>
                                <h3>Error code:</h3>
                                <p class='ms-3 errorCode'><?php echo $_ENV['ERROR']['code']; ?></p>
                                
                                <div class='accordion ms-3' id='accordionFlushExample'>
                                    <div class='accordion-item'>
                                        <h2 class='accordion-header' id='flush-headingOne'>
                                        <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapseOne' aria-expanded='false' aria-controls='flush-collapseOne'>Error Codes Table:</button>
                                        </h2>
                                        <div id='flush-collapseOne' class='accordion-collapse collapse' aria-labelledby='flush-headingOne' data-bs-parent='#accordionFlushExample'>
                                            <div class='accordion-body'>
                                                <table class='table table-striped table-dark errorsTable'>
                                                    <thead>
                                                        <tr>
                                                            <th scope='col'>Code</th>
                                                            <th scope='col'>Description</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope='row'>1</th>
                                                            <td>E_ERROR</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>2</th>
                                                            <td>E_WARNING</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>4</th>
                                                            <td>E_PARSE</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>8</th>
                                                            <td>E_NOTICE</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>16</th>
                                                            <td>E_CORE_ERROR</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>32</th>
                                                            <td>E_CORE_WARNING</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>64</th>
                                                            <td>E_COMPILE_ERROR</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>128</th>
                                                            <td>E_COMPILE_WARNING</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>256</th>
                                                            <td>E_USER_ERROR</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>512</th>
                                                            <td>E_USER_WARNING</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>1024</th>
                                                            <td>E_USER_NOTICE</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>2048</th>
                                                            <td>E_STRICT</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>4096</th>
                                                            <td>E_RECOVERABLE_ERROR</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>8192</th>
                                                            <td>E_DEPRECATED</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>16384</th>
                                                            <td>E_USER_DEPRECATED</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>30719</th>
                                                            <td>E_ALL</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-12 mt-4'>
                                <h3>Error Message:</h3>
                                <p class='ms-3'><?php echo $_ENV['ERROR']['msg']; ?></p>
                            </div>
                            <div class='col-12'>
                                <h3>File:</h3>
                                <?php
                                    $file = str_replace('\\', '/', $_ENV['ERROR']['file']);
                                ?>
                                <p class='ms-3'><?php echo $file ?></p>
                            </div>
                            <div class='col-12'>
                                <h3>Line:</h3>
                                <p class='ms-3'><?php echo $_ENV['ERROR']['line']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-12'>
                        <hr>
                        <h2 class="text-warning d-flex align-items-center">
                            <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-code-slash" viewBox="0 0 16 16">
                                <path d="M10.478 1.647a.5.5 0 1 0-.956-.294l-4 13a.5.5 0 0 0 .956.294zM4.854 4.146a.5.5 0 0 1 0 .708L1.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0m6.292 0a.5.5 0 0 0 0 .708L14.293 8l-3.147 3.146a.5.5 0 0 0 .708.708l3.5-3.5a.5.5 0 0 0 0-.708l-3.5-3.5a.5.5 0 0 0-.708 0"/>
                            </svg>
                            Code snippet:
                        </h2>
                        <hr>

                        <p class='lead'><strong>File name:</strong> 
                        <?php
                            if (!isset($_ENV['APP']['BASE_DIRECTORY'])) {
                                echo $file;
                            } else {
                                //change \ to / if windows
                                echo str_replace($_ENV['APP']['BASE_DIRECTORY'], '', $file);
                            }
                        ?>
                        </p>
                        <div class='row ms-3'>
                            <div class='col-12'>
                                <pre class='bg-dark text-light p-3 codeBlock'><?php //php tag must be here for correct code allignment
                                        
                                        //check if file exists
                                        if (!file_exists($file)) {
                                            echo 'File not found, it was probably evaluated code.<br><br>';
                                            echo 'Tip: Change DEBUG_BUFFER to true in .env file to see evaluated code in folder /debug.';
                                        } else {
                                            $file = fopen($_ENV['ERROR']['file'], 'r');

                                            $line = 0;
                                            while(!feof($file)) {
                                                $line++;
                                                $lineContent = fgets($file);
                                                //replace with html chars
                                                $lineContent = htmlspecialchars($lineContent);
                                                if($line === $_ENV['ERROR']['line']) {
                                                    echo "<span class='text-danger'>" . $line . " " . $lineContent . "</span>";
                                                } else {
                                                    echo $line . ' ' . $lineContent;
                                                }
                                            }
                                            fclose($file);
                                        }
                                    ?>
                                </pre>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='row my-5'>
                    <div class='col-12'>
                        <hr>
                        <h2 class="text-warning d-flex align-items-center">
                            <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-database" viewBox="0 0 16 16">
                                <path d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313M13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A5 5 0 0 0 13 5.698M14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A5 5 0 0 0 13 8.698m0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525"/>
                            </svg>
                            All Configured Variables:
                        </h2>
                        <hr>
                        <div class='row ms-3'>
                            <div class='col-12 mt-3'>
                                <h3>$_ENV</h3>
                                <pre class='ms-5 envVars'><?php print_r(isset($_ENV) ? $_ENV : 'No _ENV data'); ?></pre>
                            </div>
                            <div class='col-12 mt-3'>
                                <h3>$_SESSION</h3>
                                <pre class='ms-5'><?php print_r(isset($_SESSION) ? $_SESSION : 'No _SESSION data'); ?></pre>
                            </div>
                            <div class='col-12 mt-3'>
                                <h3>$_GET</h3>
                                <pre class='ms-5'><?php print_r(isset($_GET) ? $_GET : 'No _GET data'); ?></pre>
                            </div>
                            <div class='col-12 mt-3'>
                                <h3>$_POST</h3>
                                <pre class='ms-5'><?php print_r(isset($_POST) ? $_POST : 'No _POST data'); ?></pre>
                            </div>
                            <div class='col-12 mt-3'>
                                <h3>$_COOKIE</h3>
                                <pre class='ms-5'><?php print_r(isset($_COOKIE) ? $_COOKIE : 'No _COOKIE data'); ?></pre>
                            </div>

                            <div class='col-12 mt-3'>
                                <h3>$_REQUEST</h3>
                                <pre class='ms-5'><?php print_r(isset($_REQUEST) ? $_REQUEST : 'No _REQUEST data'); ?></pre>
                            </div>

                            <div class='col-12 mt-3'>
                                <h3>$_FILES</h3>
                                <pre class='ms-5'><?php print_r(isset($_FILES) ? $_FILES : 'No _FILES data'); ?></pre>
                            </div>

                            <div class='col-12 mt-3'>
                                <h3>$_SERVER</h3>
                                <pre class='ms-5'><?php print_r(isset($_SERVER) ? $_SERVER : 'No _SERVER data'); ?></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let text = document.querySelector('.envVars').innerHTML;
        //find all positions that contains PASS
        let needle = 'PASS';
        let needlePositions = [];
        for (let i = 0; i < text.length; i++) {
            if (text.substr(i, needle.length) === needle) {
                needlePositions.push(i);
            }
        }

        //move positions to the end of line
        let needlePositionsEnd = [];
        for (let i = 0; i < needlePositions.length; i++) {
            let position = needlePositions[i];
            let endOfLine = text.indexOf('=', position);
            needlePositionsEnd.push(endOfLine);
        }

        //replace all positions with *
        for (let i = 0; i < needlePositionsEnd.length; i++) {
            let position = needlePositionsEnd[i];
            let endOfLine = + text.indexOf('\n', position);
            text = text.substring(0, position) + '*'.repeat(endOfLine - position) + text.substring(endOfLine);
        }

        document.querySelector('.envVars').innerHTML = text;

        let errorCode = document.querySelector('.errorCode');
        for (let i = 0; i < document.querySelectorAll('.errorsTable tr').length; i++) {
            let row = document.querySelectorAll('.errorsTable tr')[i];
            if (row.querySelector('th').innerHTML == errorCode.innerHTML) {
                row.classList.add('table-danger');
                console.log(row.querySelector('td').innerHTML);
                errorCode.innerHTML += " (" + row.querySelector('td').innerHTML + ")";
                break;
            }
        }

    </script>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js' integrity='sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz' crossorigin='anonymous'></script>
</body>
</html>