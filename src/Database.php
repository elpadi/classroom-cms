<?php
namespace School;

use PDO;

class Database extends PDO {

	final public function __construct() {
		parent::__construct(sprintf('sqlite:%s/data.db', dirname(__DIR__)));
		$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function getStudentsByCourse(int $courseId) {
		return $this->query("SELECT Students.*, Courses.ID as CourseID FROM Courses JOIN Classes ON Classes.ID = Courses.ClassID JOIN Students ON Students.ClassID=Classes.ID WHERE Courses.ID=$courseId", PDO::FETCH_CLASS, 'School\Student');
	}

	public function getCourses() {
		return $this->query("SELECT * FROM Courses", PDO::FETCH_OBJ);
	}

	public function getCourse(int $id) {
		return $this->query("SELECT * FROM Courses WHERE ID=$id", PDO::FETCH_OBJ)->fetch();
	}

	public function fetchAttendance($CourseID, $ClassDate, $StudentID) {
		$stmt = $this->prepare("SELECT * FROM Attendance WHERE CourseID=? AND ClassDate=? AND StudentID=?");
		$stmt->execute(func_get_args());
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function takeAttendance() {
		$columns = 'CourseID, StudentID, ClassDate, ClassStart, ClassBreak, LabStart, LabBreak';
		$placeholders = implode(', ', array_map(function($s) { return ":$s"; }, explode(', ', $columns)));
		$stmt = $this->prepare("INSERT OR REPLACE INTO Attendance($columns) VALUES($placeholders)");
		foreach ($_POST['students'] as $ID => $student) {
			foreach (explode(', ', $columns) as $col) $values[$col] = isset($_POST[$col]) ? $_POST[$col] : $student[$col];
			$stmt->execute($values);
		}
	}

}
