let appointments = [];
let editingAppointmentIndex = null;

function renderAppointments() {
  const appointmentTableBody = document.getElementById("appointmentTableBody");
  appointmentTableBody.innerHTML = "";
  appointments.forEach((appointment, index) => {
    appointmentTableBody.innerHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${appointment.name}</td>
                <td>${appointment.date}</td>
                <td>${appointment.time}</td>
                <td>${appointment.description}</td>
                <td>${appointment.service}</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editAppointment(${index})">Editar</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteAppointment(${index})">Eliminar</button>
                </td>
            </tr>
        `;
  });
}

function clearForm() {
  document.getElementById("appointmentId").value = "";
  document.getElementById("appointmentName").value = "";
  document.getElementById("appointmentDate").value = "";
  document.getElementById("appointmentTime").value = "";
  document.getElementById("appointmentDescription").value = "";
  document.getElementById("inputService").value = "";
}

function saveAppointment() {
  const id = document.getElementById("appointmentId").value;
  const name = document.getElementById("appointmentName").value;
  const date = document.getElementById("appointmentDate").value;
  const time = document.getElementById("appointmentTime").value;
  const description = document.getElementById("appointmentDescription").value;
  const service = document.getElementById("inputService").value;

  const newAppointment = { name, date, time, description, service };

  if (id) {
    // Update existing appointment
    appointments[id] = newAppointment;
    editingAppointmentIndex = null;
  } else {
    // Create new appointment
    appointments.push(newAppointment);
  }

  renderAppointments();
  $("#createModal").modal("hide");
  clearForm();
}

function editAppointment(index) {
  const appointment = appointments[index];
  document.getElementById("appointmentId").value = index;
  document.getElementById("appointmentName").value = appointment.name;
  document.getElementById("appointmentDate").value = appointment.date;
  document.getElementById("appointmentTime").value = appointment.time;
  document.getElementById("appointmentDescription").value =
    appointment.description;
  document.getElementById("inputService").value = appointment.service;

  $("#createModal").modal("show");
}

function deleteAppointment(index) {
  if (confirm("¿Estás seguro de que deseas eliminar esta cita?")) {
    appointments.splice(index, 1);
    renderAppointments();
  }
}

document
  .getElementById("saveAppointmentBtn")
  .addEventListener("click", saveAppointment);

renderAppointments();
