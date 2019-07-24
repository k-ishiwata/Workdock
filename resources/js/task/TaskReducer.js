export default (state, action) => {
    const payload = action.payload;

    switch (action.type) {
        // データを全て差し替え
        case 'setTasks':
            return {
                ...state,
                tasks: payload,
            };
        // 一つの項目を選択（編集・削除用）
        case 'setTask':
            return {
                ...state,
                task: payload
            };
        // 複数の項目を選択（複数削除用）
        case 'setSelectTasks':
            return {
                ...state,
                selectTasks: payload
            };
        case 'updateTask':
            return {
                ...state,
                tasks: state.tasks.map(t => (t.id === payload.id ? payload : t)),
                isInputModal: false
            };
        // 一つの項目削除
        case 'deleteTask':
            return {
                ...state,
                tasks: state.tasks.filter(t => t.id !== payload.id),
                task: {},
                isDeleteModal: false
            };
        // 複数の項目を削除
        case 'deleteTasks':
            return {
                ...state,
                tasks: state.tasks.filter(t => payload.indexOf(t.id) == -1),
                selectTasks: [],
                isMultipleDeleteModal: false
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
        // 入力モーダル
        case 'inputModal':
            return {
                ...state,
                task: payload.task || {},
                isInputModal: payload.isInputModal
            };
        // 削除確認モーダル
        case 'deleteModal':
            return {
                ...state,
                task: payload.task || {},
                isDeleteModal: payload.isDeleteModal
            };
        // 一括削除確認モーダル
        case 'multipleDeleteModal':
            return {
                ...state,
                selectTasks: payload.selectTasks || [],
                isMultipleDeleteModal: payload.isMultipleDeleteModal
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
