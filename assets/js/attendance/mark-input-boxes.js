(function(hasAttendanceForm) {
	if (!hasAttendanceForm) return;
	var minutesLateToString = function(n) {
		switch (n) {
			case '-1': return 'Absent'; case '0': return 'Timely';
		}
		return 'Late';
	};
	Array.from(
		document.forms.attendance.querySelectorAll('input[type="number"]')
	).forEach(n => n.parentNode.classList.add(minutesLateToString(n.value).toLowerCase()));
})('attendance' in document.forms);
