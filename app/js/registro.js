// registro.js

let currentTab = 0;  // Tab inicial

// 1) Mostrar/ocultar descripción según rol
function updateDescripcionVisibility() {
  const rolSel = document.querySelector('input[name="rol"]:checked');
  const divDesc = document.getElementById('divDescripcion');
  if (rolSel && rolSel.value === 'agricultor') {
    divDesc.style.display = 'block';
  } else {
    divDesc.style.display = 'none';
  }
}

// 2) Mostrar el tab n (oculta el resto)
function showTab(n) {
  const tabs = document.getElementsByClassName('tab');
  for (let t of tabs) t.style.display = 'none';
  tabs[n].style.display = 'block';

  document.getElementById('prevBtn').style.display = n === 0 ? 'none' : 'inline';
  document.getElementById('nextBtn').innerText =
    n === tabs.length - 1 ? 'Enviar' : 'Siguiente';

  const steps = document.getElementsByClassName('step');
  for (let i = 0; i < steps.length; i++) {
    steps[i].className = steps[i].className.replace(/ active| finish/g, '');
    if (i < n)     steps[i].className += ' finish';
    if (i === n)   steps[i].className += ' active';
  }

  // 3) Si estamos en el paso 3 (index 2), actualiza la descripción
  if (n === 2) {
    updateDescripcionVisibility();
  }
}

// 4) Navega entre tabs
function nextPrev(n) {
  const tabs = document.getElementsByClassName('tab');
  if (n === 1 && !validateForm()) return false;  // valida antes de avanzar

  tabs[currentTab].style.display = 'none';
  currentTab += n;

  // Si ya terminó el wizard, envía el formulario
  if (currentTab >= tabs.length) {
    document.getElementById('regForm').submit();
    return false;
  }

  showTab(currentTab);
}

// 5) Validaciones de los campos del tab actual
function validateForm() {
  let valid = true;

  const tab = document.getElementsByClassName('tab')[currentTab];
  const inputs = tab.querySelectorAll('input, textarea');

  // Validación genérica de inputs/textarea
  for (let inp of inputs) {
    if (inp.required && !inp.value.trim()) {
      inp.classList.add('is-invalid');
      valid = false;
    } else {
      inp.classList.remove('is-invalid');
    }
    if (currentTab === 1 && inp.name === 'password2') {
      const pw1 = document.querySelector('input[name="password"]').value;
      if (inp.value !== pw1) {
        inp.classList.add('is-invalid');
        valid = false;
      }
    }
  }

  // Validación específica del Paso 1 (radio rol)
  if (currentTab === 0) {
    const rolSel = tab.querySelector('input[name="rol"]:checked');
    const rolErrorDiv = document.getElementById('rolError');
    if (!rolSel) {
      rolErrorDiv.style.display = 'block';
      valid = false;
    } else {
      rolErrorDiv.style.display = 'none';
    }
  }

  return valid;
}

// 6) Inicialización y exposición de nextPrev
document.addEventListener('DOMContentLoaded', () => {
  showTab(currentTab);

  // Exponer al scope global para onclick inline
  window.nextPrev = nextPrev;

  // 7) Listener para que, si cambias rol en cualquier momento,
  //    se vuelva a evaluar la descripción (especialmente útil en el paso 3)
  document.querySelectorAll('input[name="rol"]').forEach(radio => {
    radio.addEventListener('change', () => {
      if (currentTab === 2) {
        updateDescripcionVisibility();
      }
    });
  });
});
