function checkName(tmp) {
  if (/^[A-Za-z\s]+$/.test(tmp.value) == false && tmp.value != "")
  {
    tmp.focus();
    tmp.value="";
    tmp.style.borderColor = "red";
    tmp.style.boxShadow = "inset 0 0 3px 2px red";
    tmp.placeholder="Please, insert a valid first name";
  }
  else if (tmp.value != "")
  {
    tmp.style.borderColor = "LightGray";
    tmp.style.boxShadow = "none";
  }
}

  function checkSurname(tmp) {
    if (/^[A-Za-z\s]+$/.test(tmp.value) == false && tmp.value != "")
    {
      tmp.focus();
      tmp.value="";
      tmp.style.borderColor = "red";
      tmp.style.boxShadow = "inset 0 0 3px 2px red";
      tmp.placeholder="Please, insert a valid last name";
    }
    else if (tmp.value != "")
    {
      tmp.style.borderColor = "LightGray";
      tmp.style.boxShadow = "none";
  	}
  }

  function checkEmail(tmp) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(tmp.value) == false && tmp.value != "")
    {
      tmp.focus();
      tmp.value="";
      tmp.style.borderColor = "red";
      tmp.style.boxShadow = "inset 0 0 3px 2px red";
      tmp.placeholder="Please, insert a valid email";
    }
    else if (tmp.value != "")
    {
      tmp.style.borderColor = "LightGray";
      tmp.style.boxShadow = "none";
  	}
  }

  function checkPsw() {
    if (document.signUp.psw.value != "")
    {
      if (document.signUp.psw.value.search(" ") != -1)
      {
        document.signUp.psw.value = "";
        document.signUp.pswValidate.value = "";
        document.signUp.psw.focus();
        document.signUp.psw.style.borderColor = "red";
        document.signUp.psw.style.boxShadow = "inset 0 0 3px 2px red";
        document.signUp.psw.placeholder="Please, insert a valid password";
      }
      else if (document.signUp.pswValidate.value != "" && document.signUp.pswValidate.value.localeCompare(document.signUp.psw.value) != 0)
      {
        document.signUp.pswValidate.value = "";
        document.signUp.pswValidate.placeholder="Please, enter password";
        document.signUp.pswValidate.focus();
        document.signUp.pswValidate.style.borderColor = "red";
        document.signUp.pswValidate.style.boxShadow = "inset 0 0 3px 2px red";
      }
      else
      {
        document.signUp.pswValidate.style.borderColor = "LightGray";
        document.signUp.psw.style.borderColor = "LightGray";
      	document.signUp.psw.style.boxShadow = "none";
        document.signUp.pswValidate.style.boxShadow = "none";
      }
    }
  }

  function checkbirthDate(date) {

  }


  function checkFieldSignUp(tmp) {
    if (tmp.FirstName.value == "" || tmp.LastName.value == "" || tmp.email.value == "" || tmp.bday.value == "" || tmp.Gender.value == "" || tmp.psw.value == "" || tmp.pswValidate.value == "")
      return false;
    else {
      return true;
    }
  }


  function checkFieldLogIn(tmp) {
    if (tmp.email.value == "" || tmp.psw.value == "")
      return false;
    else {
      return true;
    }
  }
