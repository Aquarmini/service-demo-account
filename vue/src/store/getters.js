/**
 * Created by limx on 2017/10/21.
 */
export const appVersion = state => {
    return state.app.version;
}

export const userInfo = user => {
    var token = window.localStorage.getItem('token');
    api.post('/user/info', {token: token}).then(res => {

    });
    return token;
}