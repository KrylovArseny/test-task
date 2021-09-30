
window.onload = function () {
  let xhr = new XMLHttpRequest()
  let url = "option.php"
  xhr.open("POST", url, true)
  xhr.setRequestHeader("Content-Type", "application/json")
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      let res = this.responseText
      console.log(res)
      let data = JSON.parse(res)
      let nation = data[0]
      for (key in nation) {
        let one = document.querySelector('#country')
        let option = document.createElement('option')
        option.innerHTML = nation[key];
        one.append(option);
      }
      let type = data[1]
      for (key in type) {
        let one = document.querySelector('#typeid')
        let option = document.createElement('option')
        option.innerHTML = type[key]
        one.append(option)
      }
    }
  };
  xhr.send()
}
function sendJSON() {
  document.querySelector('#body').classList.remove("vh");
  let country = document.querySelector('#country')
  let typeid = document.querySelector('#typeid')
  let classa = document.querySelector('#class')
  let inp = document.querySelector('#inp')
  let xhr = new XMLHttpRequest()
  let url = "json.php"
  xhr.open("POST", url, true)

  xhr.setRequestHeader("Content-Type", "application/json")
  Intl.DateTimeFormat().resolvedOptions().timeZone

  xhr.onreadystatechange = function () {

    if (xhr.readyState === 4 && xhr.status === 200) {
      res = this.responseText
      let response = document.querySelector('#response')
      response.innerHTML = []

      let data = JSON.parse(res);
      for (let i = 0; i < data.length; i++) {
        for (key in data[i]) {
          if (key = 'date') {
            let d = new Date(data[i][key])
            data[i][key] = d
          }
        }
      }
      for (let i = 0; i < data.length; i++) {
        let div = document.createElement('div')
        response.append(div);
        for (key in data[i]) {
            let p = document.createElement('p')
            p.innerHTML = data[i][key]
            div.append(p)
        }
      }
    }
  };
  let data = JSON.stringify({ "country": country.value, "typeid": typeid.value, "classa": classa.value, "inp": inp.value })
  xhr.send(data);
}
