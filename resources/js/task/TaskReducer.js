export default (state, action) => {
    const payload = action.payload;

    switch (action.type) {
        // データを全て差し替え
        case 'setTasks':
            return {
                ...state,
                tasks: payload,
            };
        case 'setTask':
            return {
                ...state,
                task: payload
            };
        case 'updateTask':
            return {
                ...state,
                tasks: state.tasks.map(t => (t.id === payload.id ? payload : t)),
                isInputModal: false
            };
        case 'deleteTask':
            return {
                ...state,
                tasks: state.tasks.filter(t => t.id !== payload.id),
                isDeleteModal: false
            };
        // データの追加
        case 'addTask':
            return {
                ...state,
                tasks: [
                    payload,
                    ...state.tasks
                ],
                isInputModal: false
            };
        case 'openEditModal':
            return {
                ...state,
                task: payload,
                isInputModal: true
            };
        case 'closeEditModal':
            return {
                ...state,
                task: {},
                isInputModal: false
            };
        case 'inputModal':
            return {
                ...state,
                task: payload.task || {},
                isInputModal: payload.isInputModal
            };
        case 'deleteModal':
            return {
                ...state,
                task: payload.task || {},
                isDeleteModal: payload.isDeleteModal
            };
        case 'setProjects':
            return {
                ...state,
                projects: payload
            };
        case 'setUsers':
            return {
                ...state,
                users: payload
            };
        case 'setFilterQuery':
            return {
                ...state,
                filterQuery: payload
            };
        default:
            return state;
    }
}
