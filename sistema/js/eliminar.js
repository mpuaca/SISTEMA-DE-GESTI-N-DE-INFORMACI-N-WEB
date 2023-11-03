function eliminar_catecumeno(codigo){
    Swal.fire({
        title: '¿Está seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, bórralo!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          mandar_php_catecumeno(codigo);
        }
      })
}
function mandar_php_catecumeno(codigo){
    parametros = {id:codigo};
    $.ajax({
        data:parametros,
        url: "eliminar_catecumeno.php",
        type:"POST",
        beforeSend: function(){},
        success: function(){
            Swal.fire(
                '¡Eliminado!',
                'Su archivo ha sido eliminado correctamente.',
                'éxito'
              ).then((result)=>{
                window.location.href="catecumenos.php";
              })
        }
    })
}

function eliminar_beneficiario(codigo){
  Swal.fire({
      title: '¿Está seguro?',
      text: "¡No podrás revertir esto!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '¡Sí, bórralo!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        mandar_php_beneficiario(codigo);
      }
    })
}
function mandar_php_beneficiario(codigo){
  parametros = {id:codigo};
  $.ajax({
      data:parametros,
      url: "eliminar_beneficiario.php",
      type:"POST",
      beforeSend: function(){},
      success: function(){
          Swal.fire(
              '¡Eliminado!',
              'Su archivo ha sido eliminado correctamente.',
              'éxito'
            ).then((result)=>{
              window.location.href="Beneficiarios.php";
            })
      }
  })
}

function eliminar_usuario(codigo){
  Swal.fire({
      title: '¿Está seguro?',
      text: "¡No podrás revertir esto!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '¡Sí, bórralo!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        mandar_php_usuario(codigo);
      }
    })
}
function mandar_php_usuario(codigo){
  parametros = {id:codigo};
  $.ajax({
      data:parametros,
      url: "eliminar_usuario.php",
      type:"POST",
      beforeSend: function(){},
      success: function(){
          Swal.fire(
              '¡Eliminado!',
              'Su archivo ha sido eliminado correctamente.',
              'éxito'
            ).then((result)=>{
              window.location.href="usuarios.php";
            })
      }
  })
}


function eliminarCombo(codigo){
  Swal.fire({
      title: '¿Está seguro?',
      text: "¡No podrás revertir esto!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '¡Sí, bórralo!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        mandar_php_combo(codigo);
      }
    })
}
function mandar_php_combo(codigo){
  parametros = {id:codigo};
  $.ajax({
      data:parametros,
      url: "eliminar_combo.php",
      type:"POST",
      beforeSend: function(){},
      success: function(){
          Swal.fire(
              '¡Eliminado!',
              'Su archivo ha sido eliminado correctamente.',
              'éxito'
            ).then((result)=>{
              window.location.href="combo_alimentos.php";
            })
      }
  })
}
function mandar_php_catecumeno(codigo){
  parametros = {id:codigo};
  $.ajax({
      data:parametros,
      url: "eliminar_catecumeno.php",
      type:"POST",
      beforeSend: function(){},
      success: function(){
          Swal.fire(
              '¡Eliminado!',
              'Su archivo ha sido eliminado correctamente.',
              'éxito'
            ).then((result)=>{
              window.location.href="catecumenos.php";
            })
      }
  })
}

function eliminar_benefacto(codigo) {
  Swal.fire({
      title: '¿Está seguro?',
      text: "¡No podrás revertir esto!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '¡Sí, bórralo!',
      cancelButtonText: 'Cancelar'
  }).then((result) => {
      if (result.isConfirmed) {
          console.log("Código a enviar:", codigo); // Agregar esta línea para depurar
          mandar_php_benefactor(codigo);
      }
  })
}

function mandar_php_benefactor(codigo) {
  parametros = { id: codigo };
  console.log("Datos a enviar al servidor:", parametros); // Agregar esta línea para depurar

  $.ajax({
      data: parametros,
      url: "eliminar_benefacto.php",
      type: "POST",
      beforeSend: function () { },
      success: function () {
          Swal.fire(
              '¡Eliminado!',
              'Su archivo ha sido eliminado correctamente.',
              'success'
          ).then((result) => {
              window.location.href = "lista_benefactores.php";
          })
      }
  })
}
