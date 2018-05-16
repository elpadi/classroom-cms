<form method="GET" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
	<p><label>
		Select Course: 
		<select name="CourseID">
			<option value="-1">Select Course</option>
			<?php foreach ($db->getCourses() as $course): ?>
			<option value="<?php echo $course->ID; ?>"><?php echo $course->Name; ?></option>
			<?php endforeach; ?>
		</select>
	</label></p>
	<p><label>Date: <input name="ClassDate" type="date"></label></p>
	<p><input type="submit"></p>
</form>
