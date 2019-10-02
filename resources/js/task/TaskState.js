export default {
    auth: {},
    task: {},
    tasks: [],
    selectTasks: [],
    projects: [],
    users: [],
    status: [
        {},
        {
            label: '未着手',
            color: null
        },{
            label: '待機',
            color: 'purple'
        },{
            label: '進行中',
            color: 'orange'
        },{
            label: '完了',
            color: 'green'
        }
    ],
    priority: [
        null, '高', '中', '低',
    ],
    isInputModal: false,
    isDeleteModal: false,
    isMultipleDeleteModal: false,
    isTimerModal: false,
    // 開始時間
    startAt: null,
    // startAt: {
    //     hour: 0,
    //     min: 0
    // },
    filterQuery: {
        status_id: '0'
    }
};
