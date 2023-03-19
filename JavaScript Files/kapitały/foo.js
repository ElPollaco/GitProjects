function newPasswordGenerator(length){
    let newPassword = "";
    let characters = {
        standardAndNumbers: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890!@#$%^&*()",
        standardSymboles: "`-=[]\;',./~_+{}|:" + '"+,./',
        specialLetters: "ĄČĘĖĮŠŲŪŽąčęė"
    };
    let charactersLength  = characters.standardAndNumbers.length

    for(let i = 0; i < length; i++){
        newPassword += characters.standardAndNumbers.charAt(Math.random()*charactersLength);
    }
    return newPassword;
}
console.log(newPasswordGenerator(20));