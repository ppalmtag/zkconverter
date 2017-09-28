<?php
if (isset($_POST['hex'])) {
    $hex_code = filter_var($_POST['hex'], FILTER_SANITIZE_STRING);

    if (preg_match('/[[:xdigit:]]{10}/', $hex_code) === 1) {
        $result = '';
        array_map(function($val) use (&$result) {
            $binary = strrev(str_pad(base_convert($val, 16, 2), 8, '0', STR_PAD_LEFT));
            array_map(function($bin) use (&$result) {
                $result .= str_pad(base_convert($bin, 2, 10), 2, '0', STR_PAD_LEFT);
            }, str_split($binary, 4));
        }, str_split($hex_code, 2));
    } else {
        $code_invalid = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6tvslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row justify-content-md-center mt-3">
                <div class="col col-lg-4">
                    <h1>ZK-Code Converter</h1>

                    <form method="POST">
                        <div class="form-group">
                            <label for="hex">Hex Code</label>
                            <input type="text" class="form-control<?php if (isset($code_invalid)): ?> is-invalid<?php endif; ?>" <?php if (isset($code_invalid)): ?>value="<?php echo $hex_code; ?>"<?php endif; ?> id="hex" name="hex" required>
                            <div class="invalid-feedback">
                                Please enter a valid 10 digit hex code
                            </div>
                            <small id="hex" class="form-text text-muted">Enter a 10 digit hex code in the field above</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Convert</button>
                    </form>
                    <?php if (isset($result)): ?>
                        <blockquote class="blockquote text-center">
                            <p class="mb-0"><?php echo $result; ?></p>
                            <footer class="blockquote-footer" style="font-size: 60%;">as 20 digit decimal number</footer>
                        </blockquote>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/41nzFpr53nxSSGLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </body>
</html>