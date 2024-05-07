const form = document.querySelector("form");

function sendEmail() {
    // Declaration of variables
    const firstName = document.getElementById("fName");
    const lastName = document.getElementById("lName");
    const email = document.getElementById("email");
    const subject = document.getElementById("subj");
    const message = document.getElementById("msg");

    const bodyMessage = `Full Name: ${firstName.value} ${lastName.value}<br> Email: ${email.value}<br> Subject: ${subject.value}<br> Message: ${message.value}`;

    Email.send( {
        Host : "smtp.elasticemail.com",
        Username : "academicspurposes05@gmail.com",
        Password : "0F8416DFBC55804377B6ED74C7D00EC08C1C",
        To : "academicspurposes05@gmail.com",
        From : "academicspurposes05@gmail.com",
        Subject : subject.value,
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