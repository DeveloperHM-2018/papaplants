<?php
if (!empty($all_data)) {
	foreach ($all_data as $row) {
		product($row,4);
	}
} else {
	echo '<span class="text-warning">No more product  found </span>';
}
