<?php
include 'header.php';
?>

<div class="content">
    <h3>Documents</h3>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Document Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $dir = "uploads/";
            if ($handle = opendir($dir)) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        echo "<tr>
                                <td>$entry</td>
                                <td>$entry</td>
                                <td>
                                    <a href='$dir$entry' download class='btn btn-info btn-sm'>
                                        <i class='fas fa-download'></i> Download
                                    </a>
                                </td>
                              </tr>";
                    }
                }
                closedir($handle);
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include 'footer.php';
?>
