document.addEventListener("DOMContentLoaded", () => {

  // Agregar evento para el botón de agregar
  document.querySelectorAll(".btnAgregar").forEach(btn => {
    btn.addEventListener("click", async (e) => {
      const form = e.target.closest("form");
      const txtOpe = form.querySelector(".txtOpe");

      const confirmar = await mostrarPopup("agregar");
      if (confirmar) {
        txtOpe.value = "a";  // Agregar
        form.submit();
      }
    });
  });

  // Agregar evento para el botón de modificar
  document.querySelectorAll(".btnModificar").forEach(btn => {
    btn.addEventListener("click", async (e) => {
      const form = e.target.closest("form");
      const txtOpe = form.querySelector(".txtOpe");

      const confirmar = await mostrarPopup("modificar");
      if (confirmar) {
        txtOpe.value = "m";  // Modificar
        form.submit();
      }
    });
  });
  
  // Agregar evento para el botón de eliminar
  document.querySelectorAll(".btnEliminar").forEach(btn => {
    btn.addEventListener("click", async (e) => {
      const form = e.target.closest("form");
      const txtOpe = form.querySelector(".txtOpe");

      const confirmar = await mostrarPopup("eliminar");
      if (confirmar) {
        txtOpe.value = "b";  // Borrar
        form.submit();
      }
    });
  });
});

// Función para mostrar el popup
function mostrarPopup(accion) {
  return new Promise((resolve) => {
    // Crear fondo semitransparente
    const overlay = document.createElement('div');
    overlay.style.position = 'fixed';
    overlay.style.top = 0;
    overlay.style.left = 0;
    overlay.style.width = '100%';
    overlay.style.height = '100%';
    overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.4)';
    overlay.style.zIndex = 1000;

    // Crear popup tipo barra superior con color personalizado
    const popup = document.createElement('div');
    popup.style.position = 'fixed';
    popup.style.top = '20px';
    popup.style.left = '50%';
    popup.style.transform = 'translateX(-50%)';
    popup.style.background = '#1E3A8A'; // Azul oscuro
    popup.style.color = '#ffffff'; // Texto blanco
    popup.style.border = '2px solid #3B82F6'; // Azul más claro
    popup.style.borderRadius = '8px';
    popup.style.boxShadow = '0 2px 6px rgba(0,0,0,0.3)';
    popup.style.padding = '15px 25px';
    popup.style.display = 'flex';
    popup.style.alignItems = 'center';
    popup.style.gap = '10px';
    popup.style.zIndex = 1001;
    popup.style.animation = 'slideDown 0.3s ease-out';

    // Mensaje
    const message = document.createElement('span');
    message.style.flex = '1';
    message.style.fontSize = '16px';
    message.textContent = 
      accion === 'eliminar' ? '¿Seguro que desea eliminar este contacto?' :
      accion === 'modificar' ? '¿Seguro que desea modificar este contacto?' :
      accion === 'agregar' ? '¿Seguro que desea agregar este contacto?' :
      '¿Está seguro de realizar esta acción?';

    // Botón aceptar
    const btnAceptar = document.createElement('button');
    btnAceptar.textContent = 'Aceptar';
    btnAceptar.style.background = '#10B981'; // Verde
    btnAceptar.style.color = '#fff';
    btnAceptar.style.border = 'none';
    btnAceptar.style.padding = '6px 12px';
    btnAceptar.style.borderRadius = '5px';
    btnAceptar.style.cursor = 'pointer';

    // Botón cancelar
    const btnCancelar = document.createElement('button');
    btnCancelar.textContent = 'Cancelar';
    btnCancelar.style.background = '#EF4444'; // Rojo
    btnCancelar.style.color = '#fff';
    btnCancelar.style.border = 'none';
    btnCancelar.style.padding = '6px 12px';
    btnCancelar.style.borderRadius = '5px';
    btnCancelar.style.cursor = 'pointer';

    // Eventos
    btnAceptar.addEventListener('click', () => {
      document.body.removeChild(overlay);
      document.body.removeChild(popup);
      resolve(true);
    });

    btnCancelar.addEventListener('click', () => {
      document.body.removeChild(overlay);
      document.body.removeChild(popup);
      resolve(false);
    });

    popup.appendChild(message);
    popup.appendChild(btnAceptar);
    popup.appendChild(btnCancelar);
    document.body.appendChild(overlay);
    document.body.appendChild(popup);

    // Animación
    const style = document.createElement('style');
    style.textContent = `
      @keyframes slideDown {
        from { top: -100px; opacity: 0; }
        to { top: 20px; opacity: 1; }
      }
    `;
    document.head.appendChild(style);
  });
}
