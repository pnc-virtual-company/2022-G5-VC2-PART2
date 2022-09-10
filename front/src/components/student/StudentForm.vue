<template>
  <div class="main-form">
    <div class="p-2 bg-blue-500 text-center">
      <h2>Create Student</h2>
    </div>
    <form>
      <div class="name">
        <div class="firstName">
          <b><label for="firstNameInput">First name</label></b>
          <br />
          <input
            type="text"
            name="firstNameInput"
            id="firstNameInput"
            placeholder="Firstname ..."
          />
        </div>
        <div class="lastName">
          <b><label for="lastNameInput">Last name</label></b>
          <br />
          <input
            type="text"
            name="lastNameInput"
            id="lastNameInput"
            placeholder="Lastname ..."
          />
        </div>
      </div>
      <div class="email">
        <b><label for="emailInput">Email</label></b>
        <br />
        <input
          type="email"
          name="emailInput"
          id="emailInput"
          placeholder="Email ..."
        />
      </div>
      <div class="phone">
        <b><label for="phoneInput">Phone</label></b>
        <br />
        <input
          type="phone"
          name="phoneInput"
          id="phoneInput"
          placeholder="phone ..."
        />
      </div>
      <div class="another">
        <div class="batch">
          <b><label for="batchInput">Batch</label></b>
          <br />
          <input
            type="text"
            name="batchInput"
            id="batchInput"
            placeholder="Batch ..."
          />
        </div>
        <div class="class lastName">
          <b><label for="classInput">Class</label></b>
          <br />
          <input
            type="text"
            name="classInput"
            id="classInput"
            placeholder="class ..."
          />
        </div>
        <div class="studentId lastName">
          <b><label for="studentIdInput">Student ID</label></b>
          <br />
          <input
            type="text"
            name="studentIdInput"
            id="studentIdInput"
            placeholder="Student ID ..."
          />
        </div>
      </div>
      <div class="gender">
        <b>Gender</b>
        <div class="formGender">
          <div class="male">
            <input type="radio" name="gender" id="maleClick" />
            <label for="maleClick">Male</label>
          </div>
          <div class="female">
            <input type="radio" name="gender" id="femaleClick" />
            <label for="femaleClick">Female </label>
          </div>
        </div>
      </div>
    </form>
    <div class="button">
      <button type="buttonCancel">Cancel</button>
      <button type="buttonAdd">Add Student</button>
    </div>
  </div>
</template>

<style scoped>
.main-form {
  width: 45%;
  margin-left: 50%;
  margin-top: 20%;
  transform: translate(-50%, -50%);
  border: 2px solid black;
}
/* h2 {
  background-color: rgb(66, 66, 233);
  color: white;
  text-align: center;
  margin: 0;
  padding: 5px;
} */
form {
  padding: 20px;
}
form * {
  margin-top: 5px;
}
form .name {
  display: grid;
  grid-area: auto auto;
  grid-template-areas: "firstName lastName";
}
form .another {
  display: grid;
  grid-area: auto auto auto;
  grid-template-areas: "batch class studentId";
}
input[type="text"],
input[type="email"],
input[type="phone"] {
  width: 100%;
  box-sizing: border-box;
  outline: none;
  margin-top: 5px;
  padding: 8px;
  color: rgb(83, 87, 87);
}
.lastName {
  margin-left: 10px;
}
.gender {
  width: 50%;
}
.formGender {
  display: flex;
}
#femaleClick {
  margin-left: 20px;
}
.button {
  display: flex;
  padding: 10px;
  justify-content: end;
}
</style>
