
function countChar(val) {
  var len = val.value.length;
  if (len >= 255) {
    val.value = val.value.substring(0, 255);
  } else {
    $('#charNum').text(255 - len);
  }
};

function countCharNick(val) {
  var len = val.value.length;
  if (len >= 15) {
    val.value = val.value.substring(0, 15);
  } else {
    $('#charNumNick').text(15 - len);
  }
};
