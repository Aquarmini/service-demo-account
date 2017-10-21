/**
 * Created by limx on 2017/10/21.
 */
import * as types from '../mutation-types'

// initial state
const state = {
    token: 'ddd',
    info: {},
    status: false,
}

// getters
const getters = {
    token: token => {
        return state.token
    },
    user: info => state.info,
    isLogin: status => state.status,
}

const mutations = {

    // 设置用户信息
    [types.USER_SET_INFO](state, token, info){
        state.token = token;
        state.info = info;
        state.status = true;
    }
}

export default {
    state,
    getters,
    mutations
}