const form = document.getElementById('contactForm');
const spinner = document.getElementById('spinner');
const BotonSubmit = document.getElementById('submit');

form.addEventListener('submit', async (e) => {
	e.preventDefault();

	  // Mostrar spinner
	spinner.classList.remove('invisible');
	BotonSubmit.classList.add('invisible');
  	

	const formData = new FormData(form);

	// Enviar datos a correo.php usando fetch
	const response = await fetch('correo.php', {
    method: 'POST',
    body: formData,
	});

  // Ocultar spinner
	spinner.classList.add('invisible');
	// acá iri el BotonSubmit.classList.remove('invisible');
	form.reset();

  // Mostrar mensaje de éxito o error
  if (response.ok) {
    // Mostrar mensaje de éxito
	  const DivSuccess = document.getElementById("success");
	  cambiarClaseTemporalmente(DivSuccess, "visible", 25000); // 2 segundos
  } else {
    // Mostrar mensaje de error
	  const DivError = document.getElementById("Error");
	  cambiarClaseTemporalmente(DivError, "clase-temporal", 25000); // 2 segundos
  }
});



function cambiarClaseTemporalmente(div, claseNueva, tiempo) {
  // Obtener la clase original del div
  const claseOriginal = div.className;
	div.classList.remove(claseOriginal);

  // Agregar la clase nueva al div
  div.classList.add(claseNueva);

  // Función para volver a la clase original
  const volverAClaseOriginal = () => {
    div.classList.remove(claseNueva);
    div.classList.add(claseOriginal);
	BotonSubmit.classList.remove('invisible');
  };

  // Establecer un temporizador para volver a la clase original
  setTimeout(volverAClaseOriginal, tiempo);
}



