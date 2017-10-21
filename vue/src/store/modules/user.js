/**
 * Created by limx on 2017/10/21.
 */
import * as types from '../mutation-types'

// initial state
const state = {
    token: null,
    user: {},
    status: false,
}

// getters
const getters = {
    token: token => {
        return state.token
    },
    user: user => state.user,
    isLogin: status => state.status,
}

const mutations = {

    // 设置用户信息
    [types.USER_SET_INFO](state, {token, user}){
        state.token = token;
        state.user = user;
        state.status = true;
    }
}

export default {
    state,
    getters,
    mutations
}