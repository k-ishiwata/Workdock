export default {
    task: {},
    tasks: [],
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
    // alert: {
    //     isShow: false,
    //     message: '',
    //     status: ''
    // },
    filterQuery: {
        status_id: '0'
    }
};
