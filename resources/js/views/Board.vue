<!--<template>-->
<!--    <div class="row">-->
<!--        <div class="col-2">-->
<!--            <button class="btn btn-secondary button" @click="sort">-->
<!--                To original order-->
<!--            </button>-->
<!--        </div>-->

<!--        <div class="col-6">-->
<!--            <h3>Transition</h3>-->
<!--            <draggable-->
<!--                class="list-group"-->
<!--                tag="ul"-->
<!--                v-model="list"-->
<!--                v-bind="dragOptions"-->
<!--                @start="drag = true"-->
<!--                @end="drag = false"-->
<!--            >-->
<!--                <transition-group type="transition" :name="!drag ? 'flip-list' : null">-->
<!--                    <li-->
<!--                        class="list-group-item"-->
<!--                        v-for="element in list"-->
<!--                        :key="element.order"-->
<!--                    >-->
<!--                        <i-->
<!--                            :class="-->
<!--                element.fixed ? 'fa fa-anchor' : 'glyphicon glyphicon-pushpin'-->
<!--              "-->
<!--                            @click="element.fixed = !element.fixed"-->
<!--                            aria-hidden="true"-->
<!--                        ></i>-->
<!--                        {{ element.name }}-->
<!--                    </li>-->
<!--                </transition-group>-->
<!--            </draggable>-->
<!--        </div>-->

<!--        <rawDisplayer class="col-3" :value="list" title="List" />-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--    import draggable from "vuedraggable";-->
<!--    const message = [-->
<!--        "vue.draggable",-->
<!--        "draggable",-->
<!--        "component",-->
<!--        "for",-->
<!--        "vue.js 2.0",-->
<!--        "based",-->
<!--        "on",-->
<!--        "Sortablejs"-->
<!--    ];-->
<!--    export default {-->
<!--        name: "transition-example-2",-->
<!--        display: "Transitions",-->
<!--        order: 7,-->
<!--        components: {-->
<!--            draggable-->
<!--        },-->
<!--        data() {-->
<!--            return {-->
<!--                list: message.map((name, index) => {-->
<!--                    return { name, order: index + 1 };-->
<!--                }),-->
<!--                drag: false-->
<!--            };-->
<!--        },-->
<!--        methods: {-->
<!--            sort() {-->
<!--                this.list = this.list.sort((a, b) => a.order - b.order);-->
<!--            }-->
<!--        },-->
<!--        computed: {-->
<!--            dragOptions() {-->
<!--                return {-->
<!--                    animation: 200,-->
<!--                    group: "description",-->
<!--                    disabled: false,-->
<!--                    ghostClass: "ghost"-->
<!--                };-->
<!--            }-->
<!--        }-->
<!--    };-->
<!--</script>-->

<!--<style>-->
<!--    .button {-->
<!--        margin-top: 35px;-->
<!--    }-->
<!--    .flip-list-move {-->
<!--        transition: transform 0.5s;-->
<!--    }-->
<!--    .no-move {-->
<!--        transition: transform 0s;-->
<!--    }-->
<!--    .ghost {-->
<!--        opacity: 0.5;-->
<!--        background: #c8ebfb;-->
<!--    }-->
<!--    .list-group {-->
<!--        min-height: 20px;-->
<!--    }-->
<!--    .list-group-item {-->
<!--        cursor: move;-->
<!--    }-->
<!--    .list-group-item i {-->
<!--        cursor: pointer;-->
<!--    }-->
<!--</style>-->

<template>
    <div class="">
        <div class="nav">
            <ul class="nav__list">
                <li class="nav__item"><a class="nav__link" href="#">Started</a></li>
                <li class="nav__item"><a class="nav__link" href="#">Started</a></li>
                <li class="nav__item"><a class="nav__link" href="#">Templates</a></li>
                <li class="nav__item">
                    <a class="nav__link active" href="#">Create</a>
                </li>
            </ul>
            <div class="search__bar">
                <i class="fas fa-search"></i>
                <input class="nav__search" type="text" placeholder="Search" />
            </div>
        </div>

        <section>
            <div class="list__title">
                <h3>Front End Questionaires</h3>
            </div>
        </section>

        <section>
            <div class="todo-cards">
                <draggable class="d-inline-block" element="div" v-model="columns" :options="dragOptions">
                    <transition-group class="row">
                        <div class="todo-cards__wrapper" v-for="(column,column_index) in columns" :key="column.id">
                            <div class="todo-cards__card">
                                <div class="todo-cards__card-header">
                                    <div class="todo-box__item">
                                        <div class="todo-box__item-text" v-if="column === editingColumn">
                                            <input type="text" class="text-input"
                                                   @keyup.enter="endEditingColumn(column)" @blur="endEditingColumn(column)" v-model="column.title"
                                            >
                                        </div>

                                        <div v-else class="todo-box__item-text" @click="editColumn(column)">
                                            {{ column.title }}
                                        </div>

                                        <div class="close-icon" @click="deleteColumn(column, column_index)">
                                            <i class="fas fa-times"></i>
                                        </div>
                                    </div>
                                    <draggable :options="dragOptions" element="div" @end="changeOrder" :list="column.cards" group="my-group" class="todo-box__car-wrap">
                                        <transition-group class="card--holder" :id="column.id">
                                            <div v-for="card in column.cards" :key="card.column_id+','+card.order" :id="card.id">
                                                <div class="todo-sample__card transit-1" v-if="card !== editingCard">
                                                    <div class="pencil-icon" @click="editCard(card)">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </div>
                                                    <p>{{card.title}}</p>
                                                </div>

                                                <div class="addCard__text" v-if="card === editingCard">
                                                    <input type="text" class="text-input"
                                                           @keyup.enter="endEditingCard(card)" @blur="endEditingCard(card)" v-model="card.title"
                                                    >
                                                    <div class="addCard__button">
                                                        <button @click="endEditingCard(card)">Update Card</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </transition-group>
                                    </draggable>

                                    <div class="addCard__text" v-if="column.addNewCard === true">
                                        <input type="text" class="text-input">
                                        <div class="addCard__button">
                                            <button style="margin-right: 10px;" @click="saveNewCard(column)">Save</button>
                                            <i class="fas fa-times" @click="column.addNewCard = false"></i>
                                        </div>
                                    </div>


                                    <div class="todo-add__card" @click="column.addNewCard = true">
                                        <div class="add-icon">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                        <p>Add a card</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition-group>
                </draggable>

                <div class="todo-cards__wrapper">
                    <div class="todo-cards__card todo-header__list">
                        <div class="todo-cards__card-header">
                            <div v-if="new_column.on">
                                <input type="text" class="text-input full" v-model="new_column.title">
                                <div class="addCard__button">
                                    <button style="margin-right: 10px;" @click="saveNewColumn()">Save</button>
                                    <i class="fas fa-times" @click="new_column.on = false"></i>
                                </div>
                            </div>

                            <div v-else class="todo-add__card" @click="createNewColumn()">
                                <div class="add-icon">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <p>Add New Column</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'
    const message = [
        "vue.draggable",
        "draggable",
        "component",
        "for",
        "vue.js 2.0",
        "based",
        "on",
        "Sortablejs"
    ];
    export default {
        data() {
            return {
                columns: [],

                editingColumn : null,
                editingCard : null,
                new_column: {
                    title: '',
                    on: false
                },
                drag: false,
                token: 'y4uKv64GvirOaRtqz0lPjFhWwQkccukN6hHhVdDWFqvJJs5AyftTnFTN2EWo',
                api_url: 'http://127.0.0.1:8000/api/lists'
            };
        },
        components: {
            draggable,
        },
        mounted() {
            this.loadAllColumns()
        },
        methods : {
            loadAllColumns() {
                axios.get(this.api_url+'?api_token='+this.token).then(response => {
                    console.log(response)
                    response.data.data.forEach((data) => {
                        data.addNewCard =false
                        this.columns.push(data)
                    })
                })
            },
            addNew(id) {
                let user_id = 1
                let name = "New task"
                let category_id = this.categories[id].id
                let order = this.categories[id].tasks.length
                axios.post('api/task', {user_id, name, order, category_id}).then(response => {
                    this.categories[id].tasks.push(response.data.data)
                })
            },
            loadTasks() {
                this.categories.map(category => {
                    axios.get(`api/category/${category.id}/tasks`).then(response => {
                        category.tasks = response.data
                    })
                })
            },
            changeOrder(data) {
                let toTask = data.to
                let fromTask = data.from
                let task_id = data.item.id
                let category_id = fromTask.id === toTask.id ? null : toTask.id
                let order = data.newIndex === data.oldIndex && category_id === null ? false : data.newIndex

                if (order !== false) {
                    console.log('order change axios')
                    console.log('Task Id: ', task_id)
                    console.log('Column Id: ', category_id)
                    console.log('Order: ', order)
                    // axios.patch(`api/task/${task_id}`, {order, category_id}).then(response => {
                    //     // Do anything you want here
                    // });
                }
            },
            createNewColumn() {
                this.new_column.on = true
            },
            saveNewColumn() {
                this.new_column.on = false
                axios.post(this.api_url, {
                    api_token: this.token,
                    title: this.new_column.title
                }).then(response => {
                    this.new_column.title = ''
                    this.columns.push(response.data.data)
                })
            },
            endEditingColumn(column) {
                this.editingColumn = null
                console.log("update column axiois:", column)
                axios.post(this.api_url+'/'+column.id, {
                    api_token: this.token,
                    id: column.id,
                    title: column.title,
                }).then(response => {})
            },
            deleteColumn(column, column_index) {
                if(confirm("Do you really want to delete?")){
                    axios.post(this.api_url+'/delete/'+column.id, {
                        api_token: this.token,
                        id: column.id
                    }).then(response => {
                        this.columns.splice(column_index, 1);
                    })
                }
            },
            endEditingCard(card) {
                this.editingCard = null
                console.log("update card axiois:", card)
                // axios.patch(`api/task/${task.id}`, {name: task.name}).then(response => {
                //     You can do anything you wan't here.
                // })
            },
            saveNewCard(column) {
                column.addNewCard = false;
            },
            editColumn(column) {
                this.editingColumn = column
            },
            editCard(card) {
                this.editingCard = card
            }
        },
        computed: {
            dragOptions() {
                return {
                    animation: 1,
                    group: "description",
                    disabled: false,
                    ghostClass: "ghost"
                };
            }
        }
    }
</script>
<style>
    .button {
        margin-top: 35px;
    }
    .flip-list-move {
        transition: transform 0.5s;
    }
    .no-move {
        transition: transform 0s;
    }
    .ghost {
        opacity: 0.5;
        background: #c8ebfb;
    }
    .list-group {
        min-height: 20px;
    }
    .list-group-item {
        cursor: move;
    }
    .list-group-item i {
        cursor: pointer;
    }
</style>
