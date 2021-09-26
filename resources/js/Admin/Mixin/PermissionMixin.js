export default {
    methods: {
        $can(permissionName) {
            if(window.getPermission){
                return window.getPermission.indexOf(permissionName) !== -1;
            }
        },
    },
};
