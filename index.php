<?php
if (isset($_POST['hex'])) {
    $hex_code = filter_var($_POST['hex'], FILTER_SANITIZE_STRING);

    if (preg_match('/[[:xdigit:]]{10}/', $hex_code) === 1) {
        $zk = '';
        array_map(function($val) use (&$zk) {
            $binary = strrev(str_pad(base_convert($val, 16, 2), 8, '0', STR_PAD_LEFT));
            array_map(function($bin) use (&$zk) {
                $zk .= str_pad(base_convert($bin, 2, 10), 2, '0', STR_PAD_LEFT);
            }, str_split($binary, 4));
        }, str_split($hex_code, 2));

        $weg_26 = str_pad(base_convert(substr($_POST['hex'], -6, 2), 16, 10), 3, '0', STR_PAD_LEFT) . str_pad(base_convert(substr($_POST['hex'], -4), 16, 10), 5, '0', STR_PAD_LEFT);
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row justify-content-md-center mt-3">
                <div class="col col-lg-4">
                    <h1>ZK-Code & WEG 26 Converter</h1>

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
                    <?php if (isset($zk) && isset($weg_26)): ?>
                        <div class="row justify-content-md-center mt-3">
                            <div class="col col-2">
                                <p>ZK-Code</p>
                            </div>
                            <div class="col col-4">
                                <p class="mb-0"><?php echo $zk; ?></p>
                                <footer class="blockquote-footer" style="font-size: 60%;">as 20 digit decimal number</footer>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-2">
                                <p>WEG 26</p>
                            </div>
                            <div class="col-4">
                                <p class="mb-0"> <?php echo $weg_26; ?></p>
                                <footer class="blockquote-footer" style="font-size: 60%;">as 8 digit decimal number</footer>
                            </div>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>