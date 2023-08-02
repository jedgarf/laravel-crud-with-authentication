function logout() {
	
	Swal.fire({
	  title: 'Are you sure, you want to logout?',
	  showDenyButton: false,
	  showCancelButton: true,
	  confirmButtonText: 'Confirm',
	  denyButtonText: `Don't save`,
	}).then((result) => {
	  /* Read more about isConfirmed, isDenied below */
	  if (result.isConfirmed) {
	    window.location.href = '/auth/logout';
	  } else {
	    return false;
	  }
	})

}

function goto_students() {
	window.location.href = '/admin/students';
}

function goto_create() {
	window.location.href = 'students/create';
}

function selectAllStudent(elem) {
	
	if (elem.is(':checked')) {
		$(".single-select").prop("checked", true);
	} else {
		$(".single-select").prop("checked", false);
	}

}

function deleteConfirm(id, student_id) {
	
	Swal.fire({
	  title: 'Do you want to remove ' + student_id + '?',
	  showDenyButton: false,
	  showCancelButton: true,
	  confirmButtonText: 'Confirm',
	  denyButtonText: `Don't save`,
	}).then((result) => {
	  /* Read more about isConfirmed, isDenied below */
	  if (result.isConfirmed) {
	     window.location.href = 'students/delete/' + id;
	  } else {
	    return false;
	  }
	})

}

function multipleDeleteConfirm() {

	var checkedVals = $('.single-select:checkbox:checked').map(function() {
	    return this.value;
	}).get();
	
	if (checkedVals != ""){

		Swal.fire({
		  title: 'Do you want to remove all selected student?',
		  showDenyButton: false,
		  showCancelButton: true,
		  confirmButtonText: 'Confirm',
		  denyButtonText: `Don't save`,
		}).then((result) => {
		  /* Read more about isConfirmed, isDenied below */
		  if (result.isConfirmed) {
		    window.location.href = 'students/multipleDelete/' + checkedVals;
		  } else {
		    return false;
		  }
		})

	} else {
		return false;
	}

}