<?php
 $printer = "\\\\servername\\printername";
 $handle = printer_open($printer);
 printer_set_option($handle, PRINTER_MODE, "raw");
 printer_set_option($handle, PRINTER_PAPER_FORMAT, PRINTER_FORMAT_A5);
 $output = "Print Contents";
 printer_write($handle,$output);
    printer_close($handle);
?>