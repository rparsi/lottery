import $ from 'jquery';

export default class ModalTest {
    constructor () {

    }

    get user() {
        // later this needs to be moved to the 'store' which represents the app state (aka model)
        return {
            id: 99,
            firstName: 'Rahi',
            lastName: 'Parsi'
        };
    }

    init() {
        let self = this;
        $('ul.dropdown-menu li').click({ view: self }, function (event){
            let view = event.data.view;
            view.showModal();
        });
    }

    showModal() {
        $('#myModal').modal('show');
    }
}
