/*
*
*
*
*	TOGGLER
*
*
*
*/

$(function() {
	$('.navbar-toggler').on('click', function() {
		$('.div-navleft').toggleClass('hidden');
	
		/*
		if( $('#sidebar-toggler').hasClass('active') ){
			$('#toggle-navigation').removeClass('bi-chevron-right');
			$('#toggle-navigation').addClass('bi-chevron-left');
		}else {
			$('#toggle-navigation').removeClass('bi-chevron-left');
			$('#toggle-navigation').addClass('bi-chevron-right');
		}
	*/

	});
});
/*
*
*
*
*	DATEPICKER
*
*
*
*/

$('input[name="daterange"]').daterangepicker(
{
  locale: {
    format: 'DD/MM/YYYY',
  }
}, function(start, end, label) {
		timer = setInterval(function(){
			var preNominaFormHeader = document.getElementById("preNominaFormHeader");
			if (preNominaFormHeader) {
				preNominaFormHeader.submit();
			}
			clearInterval(timer)
		},200);
	}
);

$('input[name="daterange_nom"]').daterangepicker(
{
  locale: {
    format: 'DD/MM/YYYY',
  }
}, function(start, end, label) {
		timer = setInterval(function(){
			var nominaFormHeader = document.getElementById("nominaFormHeader");
			if (nominaFormHeader) {
				nominaFormHeader.submit();
			}
			clearInterval(timer)
		},200);
	}
);

/*
*
*
*
*	NOMINA: ASIGNACIONES / DEDUCCIONES
*
*
*
*/

var applyNominaConceptosModal = document.getElementById('applyNominaConceptosModal')

if (applyNominaConceptosModal) {
		applyNominaConceptosModal.addEventListener('show.bs.modal', function (event) {
	  	var button = event.relatedTarget
	  	var employeeID = button.getAttribute('employee-id')
	  	var inputControl = applyNominaConceptosModal.querySelector('#id')
			var employeeData = button.getAttribute('data-array')

			document.getElementById('applyConceptosModalForm').reset();

			if (employeeData) {
				var employeeJSON = JSON.parse(employeeData)
				var employeeArray = employeeJSON["info"]

				if (employeeJSON["info"]) {
					employeeArray = employeeJSON["info"]
				}else{
					employeeArray = employeeJSON
				}

				for (var k in employeeArray) {
					var idname = k
					var newid = idname.replace(/ /g, '_')

					if ( $("input[name='"+ newid +"']") ) {
						var inputObject_A = applyNominaConceptosModal.querySelector("input[name='"+ newid +"']")
						inputObject_A.value = employeeArray[k][0]
					}	

					if (employeeArray[k][1]){
						if ( $("input[name='"+ newid +":amount']") ) {
							var inputObject_B = applyNominaConceptosModal.querySelector("input[name='"+ newid +":amount']")
							inputObject_B.value = employeeArray[k][1]
						}
					}
				}
				
			}

	  inputControl.value = employeeID

	  var date = button.getAttribute('daterange')
	  var inputControlDate = applyNominaConceptosModal.querySelector('#from_to')

	  inputControlDate.value = date


		var employeeName = button.getAttribute('employeeName')
		var employeeNameControl = applyNominaConceptosModal.querySelector('#nominaEmployeeName')
		employeeNameControl.value = employeeName

		var employeeSalary = button.getAttribute('employeeSalary')
		var employeeSalaryControl = applyNominaConceptosModal.querySelector('#nominaEmployeeSalario')
		employeeSalaryControl.value = employeeSalary
	});
}

/*
*
*
*
*	CUSTOM DROPDOWN
*
*
*
*/

const searchInputDropdown = document.getElementById('search-input-dropdown');
const dropdownOptions = document.querySelectorAll('.input-group-dropdown-item');

if (searchInputDropdown) {
	searchInputDropdown.addEventListener('input', () => {
	  const filter = searchInputDropdown.value.toLowerCase();
	  showOptions();
	  const valueExist = !!filter.length;

	  if (valueExist) {
	    dropdownOptions.forEach((el) => {
	      const elText = el.textContent.trim().toLowerCase();
	      const isIncluded = elText.includes(filter);
	      if (!isIncluded) {
	        el.style.display = 'none';
	      }
	    });
	  }
	});
}

const showOptions = () => {
  dropdownOptions.forEach((el) => {
    el.style.display = 'flex';
  })
}

/*
*
*
*
*	DATA TABLES
*
*
*
*/

$(document).ready( function () {
    $('.datatable').DataTable();
} );

/*
*
*
*
*	PRENOMINA: ASIGNACIONES / DEDUCCIONES
*
*
*
*/

var applyConceptosModal = document.getElementById('applyConceptosModal')

if (applyConceptosModal) {
		applyConceptosModal.addEventListener('show.bs.modal', function (event) {
	  	var button = event.relatedTarget
	  	var employeeID = button.getAttribute('employee-id')
	  	var inputControl = applyConceptosModal.querySelector('#id')
			var employeeData = button.getAttribute('data-array')

			if (employeeData) {
				var employeeArray = JSON.parse(employeeData)

				for (var k in employeeArray) {
					var idname = k
					var newid = idname.replace(/ /g, '_')

					if ( $("input[name='"+ newid +"']") ) {
						var inputObject_A = applyConceptosModal.querySelector("input[name='"+ newid +"']")
						inputObject_A.value = employeeArray[k]
					}		  
				}
			}else{
				document.getElementById('applyConceptosModalForm').reset();
			}

	  inputControl.value = employeeID
	});
}

/*
*
*
*
*	EMPLEADOS
*
*
*
*/

var editEmployeeModal = document.getElementById('editEmployeeModal')

if (editEmployeeModal) {
		editEmployeeModal.addEventListener('show.bs.modal', function (event) {
	  	var button = event.relatedTarget
	  	var id = button.getAttribute('data-bs-whatever')
	  	var inputID = editEmployeeModal.querySelector('#id')
		var employeeData = button.getAttribute('data-array')

		if (employeeData) {
			var employeeArray = JSON.parse(employeeData);

			for (var k in employeeArray) {
			    var inputObject = editEmployeeModal.querySelector("#" + k)
			    if (inputObject) {
			   		inputObject.value = employeeArray[k]

				}
			}
		}

	  	inputID.value = id
	});
}

var deleteEmployeeModal = document.getElementById('deleteEmployeeModal')
if (deleteEmployeeModal) {
		deleteEmployeeModal.addEventListener('show.bs.modal', function (event) {
	  	var button = event.relatedTarget
	  	var id = button.getAttribute('data-bs-whatever')
	  	var dataName = button.getAttribute('data-name')
	  	var inputName = deleteEmployeeModal.querySelector('#name')
	  	var inputID = deleteEmployeeModal.querySelector('#id')

	  	inputName.innerHTML = dataName
	  	inputID.value = id
	});
}


/*
*
*
*
*	HORARIOS
*
*
*
*/

var editCargoModal = document.getElementById('editCargoModal')

if (editCargoModal) {
		editCargoModal.addEventListener('show.bs.modal', function (event) {
	  	var button = event.relatedTarget
	  	var id = button.getAttribute('data-bs-whatever')
	  	var inputID = editCargoModal.querySelector('#id')
		var cargoData = button.getAttribute('data-array')

		if (cargoData) {
			var cargoArray = JSON.parse(cargoData);

			for (var k in cargoArray) {
			    var inputObject = editCargoModal.querySelector("#" + k)
			    if (inputObject) {
			   		inputObject.value = cargoArray[k]

				}
			}
		}

	  	inputID.value = id
	});
}

var deleteCargoModal = document.getElementById('deleteCargoModal')
if (deleteCargoModal) {
		deleteCargoModal.addEventListener('show.bs.modal', function (event) {
	  	var button = event.relatedTarget
	  	var id = button.getAttribute('data-bs-whatever')
	  	var dataName = button.getAttribute('data-name')
	  	var inputName = deleteCargoModal.querySelector('#name')
	  	var inputID = deleteCargoModal.querySelector('#id')

	  	inputName.innerHTML = dataName
	  	inputID.value = id
	});
}

/*
*
*
*
*	HORARIOS
*
*
*
*/

var editHorarioModal = document.getElementById('editHorarioModal')

if (editHorarioModal) {
		editHorarioModal.addEventListener('show.bs.modal', function (event) {
	  	var button = event.relatedTarget
	  	var id = button.getAttribute('data-bs-whatever')
	  	var dataNameIn = button.getAttribute('data-hr-in')
	  	var dataNameOut = button.getAttribute('data-hr-out')
	  	var inputName_in = editHorarioModal.querySelector('#hr_in')
	  	var inputName_out = editHorarioModal.querySelector('#hr_out')
	  	var inputID = editHorarioModal.querySelector('#id')

	  	inputName_in.value = dataNameIn
	  	inputName_out.value = dataNameOut
	  	inputID.value = id
	});
}

var deleteHorarioModal = document.getElementById('deleteHorarioModal')
if (deleteHorarioModal) {
		deleteHorarioModal.addEventListener('show.bs.modal', function (event) {
	  	var button = event.relatedTarget
	  	var id = button.getAttribute('data-bs-whatever')
	  	var dataName = button.getAttribute('data-name')
	  	var inputName = deleteHorarioModal.querySelector('#name')
	  	var inputID = deleteHorarioModal.querySelector('#id')

	  	inputName.innerHTML = dataName
	  	inputID.value = id
	});
}

/*
*
*
*
*	ASISTENCIAS
*
*
*
*/

var editAsistenciaModal = document.getElementById('editAsistenciaModal')

if (editAsistenciaModal) {
		editAsistenciaModal.addEventListener('show.bs.modal', function (event) {
	  	var button = event.relatedTarget
	  	var id = button.getAttribute('data-bs-whatever')
	  	var inputID = editAsistenciaModal.querySelector('#id')

	  	inputID.value = id
	});
}

/*
*
*
*
*	EMPLEADOS
*
*
*
*/

var editEmployeeModal = document.getElementById('editEmployeeModal')

if (editEmployeeModal) {
		editEmployeeModal.addEventListener('show.bs.modal', function (event) {
	  	var button = event.relatedTarget
	  	var id = button.getAttribute('data-bs-whatever')
	  	var inputID = editEmployeeModal.querySelector('#id')
		var employeeData = button.getAttribute('data-array')

		if (employeeData) {
			var employeeArray = JSON.parse(employeeData);

			for (var k in employeeArray) {
			    var inputObject = editEmployeeModal.querySelector("#" + k)
			    if (inputObject) {
			   		inputObject.value = employeeArray[k]

				}
			}
		}

	  	inputID.value = id
	});
}

var deleteEmployeeModal = document.getElementById('deleteEmployeeModal')
if (deleteEmployeeModal) {
		deleteEmployeeModal.addEventListener('show.bs.modal', function (event) {
	  	var button = event.relatedTarget
	  	var id = button.getAttribute('data-bs-whatever')
	  	var dataName = button.getAttribute('data-name')
	  	var inputName = deleteEmployeeModal.querySelector('#name')
	  	var inputID = deleteEmployeeModal.querySelector('#id')

	  	inputName.innerHTML = dataName
	  	inputID.value = id
	});
}

/*
*
*
*
*	CARGOS
*
*
*
*/

var editCargoModal = document.getElementById('editCargoModal')

if (editCargoModal) {
		editCargoModal.addEventListener('show.bs.modal', function (event) {
	  	var button = event.relatedTarget
	  	var id = button.getAttribute('data-bs-whatever')
	  	var inputID = editCargoModal.querySelector('#id')
		var cargoData = button.getAttribute('data-array')

		if (cargoData) {
			var cargoArray = JSON.parse(cargoData);

			for (var k in cargoArray) {
			    var inputObject = editCargoModal.querySelector("#" + k)
			    if (inputObject) {
			   		inputObject.value = cargoArray[k]

				}
			}
		}

	  	inputID.value = id
	});
}

var deleteCargoModal = document.getElementById('deleteCargoModal')
if (deleteCargoModal) {
		deleteCargoModal.addEventListener('show.bs.modal', function (event) {
	  	var button = event.relatedTarget
	  	var id = button.getAttribute('data-bs-whatever')
	  	var dataName = button.getAttribute('data-name')
	  	var inputName = deleteCargoModal.querySelector('#name')
	  	var inputID = deleteCargoModal.querySelector('#id')

	  	inputName.innerHTML = dataName
	  	inputID.value = id
	});
}

/*
*
*
*
*	DEPARTAMENTOS
*
*
*
*/

var editDptoModal = document.getElementById('editDptoModal')

if (editDptoModal) {
		editDptoModal.addEventListener('show.bs.modal', function (event) {
	  	var button = event.relatedTarget
	  	var id = button.getAttribute('data-bs-whatever')
	  	var dataName = button.getAttribute('data-name')
	  	var inputName = editDptoModal.querySelector('#name')
	  	var inputID = editDptoModal.querySelector('#id')

	  	inputName.value = dataName
	  	inputID.value = id
	});
}

var deleteDptoModal = document.getElementById('deleteDptoModal')
if (deleteDptoModal) {
		deleteDptoModal.addEventListener('show.bs.modal', function (event) {
	  	var button = event.relatedTarget
	  	var id = button.getAttribute('data-bs-whatever')
	  	var dataName = button.getAttribute('data-name')
	  	var inputName = deleteDptoModal.querySelector('#name')
	  	var inputID = deleteDptoModal.querySelector('#id')

	  	inputName.innerHTML = dataName
	  	inputID.value = id
	});
}

/*
*/

var deleteDeduccionModal = document.getElementById('deleteDeduccionModal')
if (deleteDeduccionModal) {
	deleteDeduccionModal.addEventListener('show.bs.modal', function (event) {
	  var button = event.relatedTarget
	  var recipient = button.getAttribute('data-bs-whatever')
	  var idName = button.getAttribute('data-name')
	  var modalBodyInputName = deleteDeduccionModal.querySelector('.selected-name')
	  var modalBodyInput = deleteDeduccionModal.querySelector('.selected-id')

	  modalBodyInputName.innerHTML = idName
	  modalBodyInput.value = recipient
	});
}

var editDeduccionModal = document.getElementById('editDeduccionModal')
if (editDeduccionModal) {
	editDeduccionModal.addEventListener('show.bs.modal', function (event) {
	  var button = event.relatedTarget
	  var recipient = button.getAttribute('data-bs-whatever')
	  var idName = button.getAttribute('data-name')
	  var modalBodyInputName = editDeduccionModal.querySelector('.selected-name')
	  var modalBodyInputID = editDeduccionModal.querySelector('.selected-id')

	  modalBodyInputName.value = idName
	  modalBodyInputID.value = recipient
	});
}

var deleteAsignacionModal = document.getElementById('deleteAsignacionModal')
if (deleteAsignacionModal) {
	deleteAsignacionModal.addEventListener('show.bs.modal', function (event) {
	  var button = event.relatedTarget
	  var recipient = button.getAttribute('data-bs-whatever')
	  var idName = button.getAttribute('data-name')
	  var modalBodyInputName = deleteAsignacionModal.querySelector('.selected-name')
	  var modalBodyInput = deleteAsignacionModal.querySelector('.selected-id')

	  modalBodyInputName.innerHTML = idName
	  modalBodyInput.value = recipient
	});
}

var editAsignacionModal = document.getElementById('editAsignacionModal')
if (editAsignacionModal) {
	editAsignacionModal.addEventListener('show.bs.modal', function (event) {
	  var button = event.relatedTarget
	  var recipient = button.getAttribute('data-bs-whatever')
	  var idName = button.getAttribute('data-name')
	  var modalBodyInputName2 = editAsignacionModal.querySelector('.selected-name')
	  var modalBodyInputID2 = editAsignacionModal.querySelector('.selected-id')

	  modalBodyInputName2.value = idName
	  modalBodyInputID2.value = recipient
	});
}