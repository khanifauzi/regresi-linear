var tagPembukaTd = '<td id="inputnya">';
var tagPenutupTd = '</td>';
var input1 = '<input class="form-control" type="text" name="input1[]" pattern="[0-9]*" required/>';
var input2 = '<input class="form-control" type="text" name="input2[]" pattern="[0-9]*" required/>';
var btn = '<td id="tombolx"><button class="btn btn-danger" type="button" onclick="deleteRow(this)"/>Delete Row</button></td>';

function tambahInput() {
  var barisInput = document.getElementById('nilai-input');
  var input = document.createElement('tr');
  var isiInput = tagPembukaTd+input1+tagPenutupTd+tagPembukaTd+input2+tagPenutupTd+btn;
  input.innerHTML = isiInput;
  barisInput.append(input);
}

function deleteRow(btn) {
  var baris = btn.parentNode.parentNode;
  baris.parentNode.removeChild(baris);
}

function validate() {
  var input = document.getElementById('nilai-input');
  var jumlahBaris = input.getElementsByTagName('tr').length;
  if (jumlahBaris > 0) {
    if (jumlahBaris != 1) {
      return true;
    }
    else {
      alert('minimal inputan 2 baris');
    }
  }
  else {
    alert('data belum ada');
  }
  return false;
}
