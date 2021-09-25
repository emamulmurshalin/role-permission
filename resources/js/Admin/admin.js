import Vue from 'vue'
window.Vue = require('vue').default;

Vue.component(
    'app-confirmation-modal',
    require('./Components/Helpers/ConfirmationModal').default
);
Vue.component(
    'admin-user-dashboard',
    require('./Components/Views/Dashboard/Dashboard').default
);

//Employee
Vue.component(
    'show-all-employee',
    require('./Components/Views/Employee/EmployeListView').default
);
Vue.component(
    'show-trash-employee',
    require('./Components/Views/Employee/SoftDeleteEmployeListView').default
);
Vue.component(
    'employee-add-edit-modal',
    require('./Components/Views/Employee/EmployeAddEditModal').default
);

//Users
Vue.component(
    'show-all-user',
    require('./Components/Views/Users/UserListView').default
);
Vue.component(
    'user-add-edit-modal',
    require('./Components/Views/Users/UserModal').default
);
