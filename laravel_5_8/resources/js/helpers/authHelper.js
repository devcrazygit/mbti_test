const ADMIN_KEY = process.env.MIX_ADMIN_KEY || "mngtoken";

function saveAdminToken(token){
    localStorage.setItem(ADMIN_KEY, token)    
}
function removeAdminToken(){
    localStorage.setItem(ADMIN_KEY, "");
}
function getAdminToken(){
    return localStorage.getItem(ADMIN_KEY)
}

export const authHelper = {
    saveAdminToken,
    getAdminToken,
    removeAdminToken
};

