/**
 * extract rar or zip file
 *
 * @since  [1.0]
 * @author Richard
 * @date   2015-05-05
 *
 * @param  [string]                      $file_path ["D:\file\path\a.rar"]
 * @param  [string]                      $to_path   ["D:\extract\to\path"]
 * @return [boolean]
 */
function extract_file($file_path, $to_path = "./")
{
        $file_type = substr($file_path, strrpos($file_path, '.') - strlen($file_path) + 1);
        if ("zip" === $file_type) {
        $xmlZip = new ZipArchive();
        if ($xmlZip->open(__DIR__."/xml.zip") === true) {
            $xmlZip->extractTo($to_path);
            echo "extract success";
        } else {
            echo "extract fail";
            return false;
        }
    } elseif ("rar" == $file_type) {

        $rar_file = rar_open($file_path) or die("Can't open Rar archive");
        $entries = rar_list($rar_file);
        if ($entries) {
                foreach ($entries as $entry) {
                echo 'Filename: ' . $entry->getName() . "\n";
                $entry->extract($to_path);
            }
            rar_close($rar_file);
        } else{
            echo "extract fail";
            return false;
        }

    }
}
