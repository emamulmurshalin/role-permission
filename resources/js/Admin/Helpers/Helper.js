window.Vue = require('vue').default;
import moment from 'moment'

export const formatDateToLocal = (date) => {
    return moment(date).format('DD/MM/YYYY');
};
export const onlyTime = (date) => {
    return  moment(date).utc(false)
        .local()
        .format(`HH:mm`);
};
export const calculateAge = (date) => {
    let dateTime;
    dateTime = Math.abs(new Date(date) - new Date());
    let days = parseInt(dateTime / (1000 * 60 * 24 * 60));
    return days + " days ";
};

export const calculateSince = (date) => {
    let dateTime;
    dateTime = Math.abs(new Date(date) - new Date());
    let days = parseInt(dateTime / (1000 * 60 * 24 * 60));
    let minutes = (parseInt(dateTime / (1000 * 60)) % (24 * 60));
    let hours = minutes > 60 ? parseInt(minutes / 60) : 0;
    let minute = minutes > 60 ? (minutes % 60) : minutes;

    return days + " days " + hours + " hours " + minute + " minutes ";
};
export const calculateId = (id, date) => {
    let createdDate = moment(date).format('DDMMYYYY');
    let formattedId;
    if (id.toString().length == 1){
        formattedId = '0000' + id;
    }else if (id.toString().length == 2){
        formattedId = '000' + id;
    }else if (id.toString().length == 3){
        formattedId = '00' + id;
    }else if (id.toString().length == 4){
        formattedId = '0' + id;
    }else {
        formattedId = id;
    }
    return createdDate + formattedId;
};
export const onlyTimeFromTime = (date, time) => {
    let d = new Date(
        moment(date).format('DD/MM/YYYY') + " " + time
    );
    return time
        ? moment(d).format(`HH:mm`)
        : "";
};
