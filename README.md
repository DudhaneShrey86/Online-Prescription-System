# Online Prescription System
## Technologies Used -
Laravel, MySQL, JQuery, Materialize CSS

## Installation
<ol>
    <li>First we have to install Laravel using composer</li>
    <li>After installing composer we have to require laravel installer by this command <code>composer global require laravel/installer</code></li>
    <li>Once you have the installer, go to the directory of the project and type in <code>php artisan serve</code></li>
    <li>The server should start, also make sure to start xampp for the database</li>
    <li>You might have to run <code>php artisan key:generate</code> as you are running an existing laravel project</li>
    <li>Setup your database variables in <b>.env</b> file, we have used mysql and our database name is <b>ideamagix_test</b></li>
    <li>We have provided a sample database in the files, so import it into your database and run the project</li>
</ol>

## Description
#### The project is an online prescription system for patients and doctors
<ul>
    <li>There are two types of users - patients and doctors</li>
    <li>Patients can seek consultation from a doctor, a list of all registered doctors is displayed to the patient</li>
    <li>After consulting the patient has to wait for the doctor to write a prescription for him, once the doctor submits a prescription the patient can view it on his side</li>
    <li>He can download a pdf of the prescription</li>
    <li>On the doctor's side, the doctor has to write prescriptions for the patients, viewing his illness details.</li>
    <li>He can edit or delete those prescriptions.</li>
</ul>

## Some Images of the interface

#### Patient's Side
![Patient's Login](https://raw.githubusercontent.com/DudhaneShrey86/Online-Prescription-System/main/public/images/patient_login.PNG)
- **Patient's Login Page**

![Search Doctors](https://github.com/DudhaneShrey86/Online-Prescription-System/tree/main/public/images/search_doctors.PNG?raw=true)
- **Search Doctors**

![Illness Form](https://github.com/DudhaneShrey86/Online-Prescription-System/tree/main/public/images/illness_form.PNG?raw=true)
- **Illness Details**

![Illness Form 2](https://github.com/DudhaneShrey86/Online-Prescription-System/tree/main/public/images/illness_form_2.PNG?raw=true)
- **Family Illness History Details**

![Payment Form](https://github.com/DudhaneShrey86/Online-Prescription-System/tree/main/public/images/payment.PNG?raw=true)
- **Payment Page [The payment is to be done and its transaction id is to be entered]**

![My Prescriptions](https://github.com/DudhaneShrey86/Online-Prescription-System/tree/main/public/images/my_prescriptions.PNG?raw=true)
- **My Prescriptions**

![Profile Page](https://github.com/DudhaneShrey86/Online-Prescription-System/tree/main/public/images/profile.PNG?raw=true)
- **Patient's Profile Page**

#### Doctor's Side

![Prescription Details](https://github.com/DudhaneShrey86/Online-Prescription-System/tree/main/public/images/prescription.PNG?raw=true)
- **Doctor writes a prescriptions for the illness**
