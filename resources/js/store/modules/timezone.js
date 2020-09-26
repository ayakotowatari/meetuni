export const timezone = {
    namespaced: true,

    state: {
        isEditing: false,

       
        
    },
    mutations: {
        setIsEditing(state){
            state.isEditing = true
        },
        hasFinishedEditing(state){
            state.isEditing = false
        },
       
    },
    actions: {
       

    }

}