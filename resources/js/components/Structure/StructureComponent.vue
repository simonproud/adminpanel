<template>
    <div>
        <a class="btn btn-success text-white" v-on:click="formvisible = !formvisible">Добавить запись</a>
        <a class="btn btn-success text-white" v-on:click="inviteUser">Пригласить сотрудника</a>
        <div id="edit-panel" v-if="formvisible" class="view-state edit-container">
            <div class="item item-half">
                <div class="input-node-container">
                    <label class="selected-node-group">Selected Node</label>
                    <input type="text" id="selected-node" class="selected-node-group new-node">
                </div>
                <div>
                    <label>New Node</label>
                    <ul id="new-nodelist">
                        <li><input type="text" class="new-node form-control"></li>
                    </ul>
                </div>
            </div>
            <div id="node-type-panel" class="radio-panel item">
                <input type="radio" name="node-type" id="rd-parent" value="parent" class="form-control"><label for="rd-parent">Root</label>
                <input type="radio" name="node-type" id="rd-child" value="children" class="form-control"><label for="rd-child">Child</label>
                <input type="radio" name="node-type" id="rd-sibling" value="siblings" class="form-control"><label for="rd-sibling">Sibling</label>
            </div>
            <div class="item">
                <button class="btn btn-success text-white" @click="addNodes">Add</button>
                <button class="btn btn-success text-white" @click="deleteNodes">Delete</button>
                <button class="btn btn-success text-white" @click="exportJSON">Export JSON</button>
            </div>
        </div>
        <vo-edit :data="chartData"  :nodeContent="nodeContent"></vo-edit>
    </div>
</template>

<script>
    import { VoBasic } from 'vue-orgchart'
    import { VoEdit } from 'vue-orgchart'
    export default {
        components: { VoEdit },
        data () {
            return {
                nodeContent: 'content',
                selectedNode: '',
                formvisible: false,
            }
        },
        methods: {
            inviteUser(){
                swal({
                    text:"Введите email будущего сотрудника:",
                    content: "input",
                    attributes:{
                        name:'email',
                    },
                    buttons: {
                        cancel: {
                            text: "Cancel",
                            value: 'cancel',
                            visible: true,
                            className: "btn",
                            closeModal: true,
                        },
                        confirm:{
                            text: "OK",
                            value: true,
                            visible: true,
                            className: "btn btn-success",
                            closeModal: true,
                        }
                    }
                })
                    .then((value) => {

                        if(value != 'cancel'){
                            console.log(value);
                        axios.post('/structure/invite', {
                           email:`${value}`,
                        })
                            .then(function (response) {
                               if(response.data.status == 'success'){
                                    swal("Успешно!", "Письмо отправлено", "success", {
                                        icon: 'success',
                                        buttons: {
                                            success:{
                                                text:'OK',
                                                className:'btn btn-success'
                                            }
                                        }
                                    });
                               }else{
                                   console.log(response);
                                   swal("Ошибка!", "Проверьте правильность ввода почтового адреса", "success", {
                                       icon: 'error',
                                       dangerMode:true,
                                       buttons: {
                                           success:{
                                               text:'OK',
                                               className:'btn btn-danger'
                                           }
                                       }
                                   });
                               }
                            })
                            .catch(function (error) {
                                swal("Ошибка!", "Проверьте правильность ввода почтового адреса", "success", {
                                    icon: 'error',
                                    dangerMode:true,
                                    buttons: {
                                        success:{
                                            text:'OK',
                                            className:'btn btn-danger'
                                        }
                                    }
                                });
                                console.log(error);
                            });
                        }
                    });
            },
            mountOrgchart() {
                this.$children.forEach((item) => {
                    item.orgchart !== undefined ? this.orgchart = item.orgchart : null
                })
            },
            showForm(event){
                event.preventDefault();

                this.formvisible = true;

            },
            addNodes() {
                let chartContainer = document.getElementById('chart-container')
                let nodeVals = []

                Array.from(document.getElementById('new-nodelist').querySelectorAll('.new-node'))
                    .forEach(item => {
                        let validVal = item.value.trim()

                        if (validVal) {
                            nodeVals.push(validVal)
                        }
                    })
                let selectedNode = document.getElementById(document.getElementById('selected-node').dataset.node)

                if (!nodeVals.length) {
                    alert('Please input value for new node')
                    return
                }
                let nodeType = document.querySelector('input[name="node-type"]:checked')

                if (!nodeType) {
                    alert('Please select a node type')
                    return
                }
                if (nodeType.value !== 'parent' && !document.querySelector('.orgchart')) {
                    alert('Please creat the root node firstly when you want to build up the orgchart from the scratch')
                    return
                }
                if (nodeType.value !== 'parent' && !selectedNode) {
                    alert('Please select one node in orgchart')
                    return
                }
                if (nodeType.value === 'parent') {
                    if (!chartContainer.children.length) {// if the original chart has been deleted
                        this.orgchart = new OrgChart({
                            'chartContainer': '#chart-container',
                            'data': { 'name': nodeVals[0] },
                            'parentNodeSymbol': 'fa-th-large',
                            'createNode': function (node, data) {
                                node.id = this.getId()
                            }
                        })
                        this.orgchart.chart.classList.add('view-state')
                    } else {
                        this.orgchart.addParent(chartContainer.querySelector('.node'), { 'name': nodeVals[0], 'Id': this.getId() })
                    }
                } else if (nodeType.value === 'siblings') {
                    this.orgchart.addSiblings(selectedNode, {
                        'siblings': nodeVals.map(item => {
                            return { 'name': item, 'relationship': '110', content:'SIBLYA', 'Id': this.getId() }
                        })
                    })
                } else {
                    let hasChild = selectedNode.parentNode.colSpan > 1

                    if (!hasChild) {
                        let rel = nodeVals.length > 1 ? '110' : '100'

                        this.orgchart.addChildren(selectedNode, {
                            'children': nodeVals.map(item => {
                                return { 'name': item, 'relationship': rel, content:'TRUEEE', 'Id': this.getId() }
                            })
                        })
                    } else {
                        this.orgchart.addSiblings(closest(selectedNode, el => el.nodeName === 'TABLE').querySelector('.nodes').querySelector('.node'),
                            { 'siblings': nodeVals.map(function (item) { return { 'name': item, 'relationship': '110', 'Id': this.getId() } })
                            })
                    }
                }
            },
            deleteNodes() {
                let sNodeInput = document.getElementById('selected-node')
                let sNode = document.getElementById(sNodeInput.dataset.node)

                if (!sNode) {
                    alert('Please select one node in orgchart')
                    return
                } else if (sNode === document.querySelector('.orgchart').querySelector('.node')) {
                    if (!window.confirm('Are you sure you want to delete the whole chart?')) {
                        return
                    }
                }
                this.orgchart.removeNodes(sNode)
                sNodeInput.value = ''
                sNodeInput.dataset.node = ''
            },
            exportJSON() {
                let datasourceJSON = {}
                let ChartJSON = this.orgchart.getChartJSON()
                datasourceJSON = JSON.stringify(ChartJSON, null, 2)
                if(document.getElementsByTagName('code')[1]) {
                    let code = document.getElementsByTagName('code')[1]
                    code.innerHTML = datasourceJSON
                }
                return datasourceJSON
            },
            getId() {
                return (new Date().getTime()) * 1000 + Math.floor(Math.random() * 1001)
            }
        },
        created () {
            this.chartData = {
                name: 'Генеральный директор',
                content: '<b>Брякунов Александр Владимирович</b>',
                children: [
                    { name: 'Отдел маркетинга' ,content: '<b>Килимистый Иван Иванович</b>',
                        children: [
                            { name: 'Программист',  content: 'Гординов Семён Игоревич', },
                           // { name: 'Дизайнер',  content: 'Ющенко Алексей Сергеевич', },
                        ]
                    },
                    {
                        name: 'Отдел продаж',
                        content: '<b>Ткачёв Игорь Павлович</b>',
                        children: [{ name: 'Продажник',  content: 'ФИО продажника', }]
                    },
                ]
            }
        }
    }
</script>
<style>
    .orgchart .node {
        width: auto;
        min-width: 190px;
    }
    .orgchart .node .title {
        background:#31373F;
        padding: 5px 10px;
        height: auto;
    }
    .orgchart .node .content {
        margin-left:0px !important;
        height: auto;
        padding: 7px 16px;
    }
</style>