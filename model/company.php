<?php
$company_name = $_POST['company_name'];
$company_code = $_POST['company_code'];
$email = $_POST['email'];
$address = $_POST['address'];
$tax_number = $_POST['tax_number'];
$file = $_SERVER['DOCUMENT_ROOT'] . '/database/company.php';

$isiFile  = "<?php\n";

$isiFile .= "\$company_name = '$company_name';\n";

$isiFile .= "\$company_code = '$company_code';\n";
$isiFile .= "\$address = '$address';\n";

$isiFile .= "\$email = '$email';\n";

$isiFile .= "\$tax_number = '$tax_number';\n";

if (file_put_contents($file, $isiFile)) {

    echo "Data Perusahaan berhasil disimpan";
} else {

    echo "Data gagal di update";
}
