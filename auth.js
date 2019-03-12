var url = 'http://64.251.10.6/Tintowin_WS/Tintowin_WS.asmx'

function request(data, success, error) {
  $.ajax({
    type: 'POST',
    url: './login.php',
    data: data,
    success: success,
    error: error
  })
}

$('.onLogin').click(function() {
  const data = { exec: 'login', data: {} }
  data.data.user = $('#user').val()
  data.data.password = $('#password').val()
  request(
    data,
    function(response) {
      $(response)
        .find('WSLoginUsuarioResult')
        .each(function() {
          const { RESULTADO, DATOS } = JSON.parse($(this)[0].innerHTML)
          console.log(RESULTADO)
          if (+RESULTADO[0][0] === 0) {
            const data = {
              exec: 'setLogin',
              data: { uid: DATOS[0][0] }
            }
            request(
              data,
              function(response) {
                location.href = 'index.php'
              },
              e => consol.log(e)
            )
          } else {
            alert(RESULTADO[0][1])
          }
        })
    },
    function(erros) {
      console.log(error)
    }
  )
})
