Array.from(document.forms).forEach(f => f.addEventListener('change', function(e) {
	let form = this, input = e.target, timeFields = ['ClassStart','ClassBreak','LabStart','LabBreak'];
	if (input.name.includes('isPresent') && input.value == 'no') {
		timeFields.forEach(s => form[input.name.replace('isPresent', s)].value = -1);
	}
}));
