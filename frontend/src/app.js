import $ from 'jquery';
import ModalTest from 'Modaltest';

$(document).ready(function () {
    let modalTest = new ModalTest();
    console.log(modalTest.user);

    modalTest.init();
});