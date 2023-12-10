<?php
/*
 * Plugin Name: GC Excel to XML Feed Generator
 * Plugin URI: http://gokhancelebi.net/iletisim/
 * Description: This plugin generates XML feed from Excel file.
 * Version: 1.0
 * Author: Gokhan Celebi
 * Author URI: http://gokhancelebi.net/iletisim/
 * License: GPL2
 */

if(!defined('ABSPATH')) exit;

// add page to upload .xlsx file to generate XML feed
add_action('admin_menu', 'gc_excel_to_xml_feed_generator_menu');
function gc_excel_to_xml_feed_generator_menu() {
	add_menu_page('GC Excel to XML Feed Generator', 'GC Excel to XML Feed Generator', 'manage_options', 'gc-excel-to-xml-feed-generator', 'gc_excel_to_xml_feed_generator_page', 'dashicons-media-spreadsheet', 6);
}

// add page to upload .xlsx file to generate XML feed
function gc_excel_to_xml_feed_generator_page() {
	if (isset($_POST['submit'])){
		// save excel file to current folder as feed.xlsx
		$excel_file = $_FILES['excel_file']['tmp_name'];
		$excel_file_name = __DIR__ .'/feed.xlsx';
		$upload_file = move_uploaded_file($excel_file, $excel_file_name);

		// show success message
		echo '<div class="notice notice-success is-dismissible"><p>XML feed generated successfully.</p></div>';
	}
	?>
	<div class="wrap">
		<h2>GC Excel to XML Feed Generator</h2>
		<form method="post" enctype="multipart/form-data">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="excel_file">Excel File</label></th>
						<td><input type="file" name="excel_file" id="excel_file" accept=".xlsx" required></td>
					</tr>
				</tbody>
			</table>
			<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Generate XML Feed"></p>
		</form>
        <p>
            Your feed url will be : <?php echo get_site_url() . '/wp-content/plugins/gc-excel-to-xml-feed-generator/feed.php'; ?>
        </p>
        <br>
        <br>
        <br>
        <br>
        <p>
            Entegrasyonum.com Web Yazılım Hizmetleri tarafından geliştirilmiştir.<br> <a href="https://entegrasyonum.com/teklif-iste">Entegrasyonum.com/teklif-iste</a> <br> <a href="https://gokhancelebi.net">Gokhancelebi.net</a>
        </p>
	</div>
	<?php

}