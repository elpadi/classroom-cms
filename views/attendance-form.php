<?php
$date = DateTime::createFromFormat('Y-m-d', $_GET['ClassDate']);
?><form name="attendance" method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
	<?php foreach ($_GET as $key => $val) printf('<input type="hidden" name="%s" value="%s">', $key, $val); ?>
	<table border="1" cellpadding="5">
		<colgroup>
			<col class="student-id">
			<col class="names" span="2">
			<col class="presence">
			<col class="lateness" span="2">
		</colgroup>
		<thead>
			<tr>
				<th colspan="8">
					<h1>Attendance Sheet</h1>
					<h2>
						<a href="?CourseID=<?php echo $_GET['CourseID']; ?>&ClassDate=<?php echo (clone $date)->modify('-1 day')->format('Y-m-d'); ?>">&lt;&lt;</a>
						<span><?php printf('Course %d "%s" for %s %s', $_GET['CourseID'], $db->getCourse($_GET['CourseID'])->Name, $date->format('l'), $_GET['ClassDate']); ?></span>
						<a href="?CourseID=<?php echo $_GET['CourseID']; ?>&ClassDate=<?php echo (clone $date)->modify('+1 day')->format('Y-m-d'); ?>">&gt;&gt;</a>
					</h2>
				</th>
			</tr>
			<tr>
				<th>ID</th>
				<th>Last Name</th>
				<th>First Name</th>
				<th>Presence</th>
				<th>Class Start</th>
				<th>Class Break</th>
				<th>Lab Start</th>
				<th>Lab Break</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($db->getStudentsByCourse($_GET['CourseID']) as $student): $att = $db->fetchAttendance($_GET['CourseID'], $_GET['ClassDate'], $student->ID); ?>
			<tr>
				<td><input type="hidden" name="students[<?php echo $student->ID; ?>][StudentID]" value="<?php echo $student->ID; ?>"><?php echo $student->ID; ?></td>
				<td><?php echo $student->LastName; ?></td>
				<td><?php echo $student->FirstName; ?></td>
				<td><label><input type="radio" name="students[<?php echo $student->ID; ?>][isPresent]" value="yes" checked> Present</label> <label><input type="radio" name="students[<?php echo $student->ID; ?>][isPresent]" value="no"> Absent</label></td>
				<td><input type="number" min="-1" name="students[<?php echo $student->ID; ?>][ClassStart]" value="<?php echo $att ? $att->ClassStart : '0'; ?>"></td>
				<td><input type="number" min="-1" name="students[<?php echo $student->ID; ?>][ClassBreak]" value="<?php echo $att ? $att->ClassBreak : '0'; ?>"></td>
				<td><input type="number" min="-1" name="students[<?php echo $student->ID; ?>][LabStart]" value="<?php echo $att ? $att->LabStart : '0'; ?>"></td>
				<td><input type="number" min="-1" name="students[<?php echo $student->ID; ?>][LabBreak]" value="<?php echo $att ? $att->LabBreak : '0'; ?>"></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="8">
					<h3><input type="submit"></h3>
				</th>
			</tr>
		</tfoot>
	</table>
</form>
