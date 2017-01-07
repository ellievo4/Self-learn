function intro() {
    "use strict";
    
    //declare var that gather form elements
    var txtName = document.getElementById("txtName"),
        txtAge = document.getElementById("txtAge"),
        txtPet = document.getElementById("txtPet"),
        txtHobby = document.getElementById("txtHobby"),
        output = document.getElementById("output"),
    
    //declare var that store input
        name = txtName.value,
        age = txtAge.value,
        pet = txtPet.value,
        hobby = txtHobby.value,
    
    //writing the profile
        profile = "I am noob " + name + ".<br/>";
    profile += "I will be homeless at " + age + " years old.<br/>";
    profile += "I kick my " + pet + "'s butt yesterday.<br/>";
    profile += "I went to jail because of " + hobby + ".<br/>";
    
    //put profile inside html
    output.innerHTML = profile;
}