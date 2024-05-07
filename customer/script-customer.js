const form = document.querySelector("form");

function sendEmail() {
    // Declaration of variables
    const fullName = document.getElementById("fName");
    const birthDay = document.getElementById("bday");
    const email = document.getElementById("email");
    const mobileNumber = document.getElementById("mobileNum");
    const nationality = document.getElementById("nationality");
    const religion = document.getElementById("religion");
    const addressType = document.getElementById("addtype");
    const address = document.getElementById("addr");
    const city = document.getElementById("city");
    const state = document.getElementById("state");
    const country = document.getElementById("country");
    const zip = document.getElementById("zip");

    const bodyMessage = `Full Name: ${fullName.value}<br> Birthday: ${birthDay.value}<br> Email: ${email.value}<br> Mobile Number: ${mobileNumber.value}<br> Nationality: ${nationality.value}<br> Religion: ${religion.value}<br> Address Type: ${addressType.value}<br> Home Address: ${address.value}<br> City: ${city.value}<br> State: ${state.value}<br> Country: ${country.value}<br> ZIP/Postal Code: ${zip.value}`;

    Email.send( {
        Host : "smtp.elasticemail.com",
        Username : "academicspurposes05@gmail.com",
        Password : "0F8416DFBC55804377B6ED74C7D00EC08C1C",
        To : email.value,
        From : "academicspurposes05@gmail.com",
        Subject : "Validate your Data",
        Body : bodyMessage
    }).then(
        message => {
            if(message == "OK") {
                // Reset the form after successful submission
                form.reset();

                // Show success message
                Swal.fire({
                    title: "Good job!",
                    text: "Message Sent Successfully! We will go back to you as soon as we can.",
                    icon: "success"
                });
            }
        }
    );
}

form.addEventListener("submit", (e) => {
  e.preventDefault();

  sendEmail();
});