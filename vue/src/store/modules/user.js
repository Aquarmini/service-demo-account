/**
 * Created by limx on 2017/10/21.
 */
import * as types from '../mutation-types'

// initial state
const state = {
    token: 'ddd',
    data: {},
}

// getters
const getters = {
    token: token => {
        return state.token
    },
    user: user => state.data
}

const mutations = {
    [types.USER_SET_TOKEN] (state, {token}) {
        state.token = token;
    },
}

export default {
    state,
    getters,
    mutations
}