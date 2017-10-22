/**
 * Created by limx on 2017/10/21.
 */
import * as types from '../mutation-types'

// initial state
const state = {
    bdUss: null,
    bdNickname: null,
    bdUserId: null,
}

// getters
const getters = {
    bdUserId: bdUserId => state.bdUserId,
    bdUss: bdUss => state.bdUss,
    bdNickname: bdNickname => state.bdNickname,
}

const mutations = {

    [types.BAIDU_SET_BAIDU_USER_ID](state, {bdUserId}){
        state.bdUserId = bdUserId;
    }
}

export default {
    state,
    getters,
    mutations
}