namespace php Xin.Thrift.Account

struct User {
    1: i64 id,
    2: string username,
    3: string avatar,
    4: string nickname,
    5: string token,
}

service Account{

    // 登录接口，获取用户数据
    User login(1:string username, 2:string password)

    // 通过Token 获取用户信息接口
    User user(1:string token)
}