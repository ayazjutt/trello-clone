<template>
    <main>
        <div class="mt-5 container">
            <div class="row justify-content-center border py-5">
                <div class="col-5">
                    <h4 class="mb-3">Draggable 1</h4>
                    <draggable class="draggable-list" :list="list1" group="my-group">
                        <div class="list-item" v-for="element in list1" :key="element.name">
                            {{ element.name }}
                        </div>
                    </draggable>
                </div>

                <div class="col-5">
                    <h4 class="mb-3">Draggable 2</h4>
                    <draggable class="draggable-list" :list="list2" group="my-group">
                        <div class="list-item" v-for="element in list2" :key="element.name">
                            {{ element.name }}
                        </div>
                    </draggable>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
    import draggable from "vuedraggable";
    export default {
        components: {
            draggable,
        },
        data() {
            return {
                list1: [{ name: "Drag Me!" }],
                list2: [{ name: "Drag Me Too!" }],
            };
        },
    };
</script>
<style scoped>
    .draggable-list {
        background: #3f51b5;
        color: #fff;
        border: 1px solid;
        height: 50vh;
    }
    .list-item {
        margin: 10px;
        padding: 40px;
        cursor: pointer;
        font-size: 18px;
        border-radius: 5px;
        background: #f44336;
        display: inline-block;
    }
</style>
<!--<template>-->
<!--    <div class="">-->
<!--        <div class="nav">-->
<!--            <ul class="nav__list">-->
<!--                <li class="nav__item"><a class="nav__link" href="#">Started</a></li>-->
<!--                <li class="nav__item"><a class="nav__link" href="#">Started</a></li>-->
<!--                <li class="nav__item"><a class="nav__link" href="#">Templates</a></li>-->
<!--                <li class="nav__item">-->
<!--                    <a class="nav__link active" href="#">Create</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--            <div class="search__bar">-->
<!--                <i class="fas fa-search"></i>-->
<!--                <input class="nav__search" type="text" placeholder="Search" />-->
<!--            </div>-->
<!--        </div>-->
<!--        <section>-->
<!--            <div class="list__title">-->
<!--                <h3>Front End Questionaires</h3>-->
<!--            </div>-->
<!--        </section>-->

<!--&lt;!&ndash;        <draggable v-model="list" group="people" @start="drag=true" @end="drag=false">&ndash;&gt;-->
<!--&lt;!&ndash;            <div v-for="element in list" :key="element.order">{{element.name}}</div>&ndash;&gt;-->
<!--&lt;!&ndash;        </draggable>&ndash;&gt;-->
<!--        <section>-->
<!--            <div class="todo-cards">-->

<!--                <div class="todo-cards__wrapper">-->
<!--                    <div class="todo-cards__card">-->
<!--                        <div class="todo-cards__card-header">-->
<!--                            <div class="todo-box__item" data-state="editable">-->
<!--                                <div class="todo-box__item-text" contenteditable="true">-->
<!--                                    To do-->
<!--                                </div>-->
<!--                                <div class="close-icon">-->
<!--                                    <i class="fas fa-times"></i>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <draggable v-model="list">-->
<!--                                <transition-group>-->
<!--                                    <div class="todo-sample__card" v-for="element in list" :key="element.order">-->
<!--                                        <div class="pencil-icon">-->
<!--                                            <i class="fas fa-pencil-alt"></i>-->
<!--                                        </div>-->
<!--                                        <p>{{element.name}}</p>-->
<!--                                    </div>-->
<!--                                </transition-group>-->
<!--                            </draggable>-->


<!--                            <div class="todo-add__card">-->
<!--                                <div class="add-icon">-->
<!--                                    <i class="fas fa-plus"></i>-->
<!--                                </div>-->
<!--                                <p>Add a card</p>-->
<!--                            </div>-->
<!--                            <div class="addCard__text">-->
<!--                                <input type="textarea" value="" />-->
<!--                                <div class="addCard__button">-->
<!--                                    <button>Add Card</button>-->
<!--                                    <i></i>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="todo-cards__wrapper">-->
<!--                    <div class="todo-cards__card">-->
<!--                        <div class="todo-cards__card-header">-->
<!--                            <div class="todo-box__item" data-state="editable">-->
<!--                                <div class="todo-box__item-text" contenteditable="true">-->
<!--                                    Pending-->
<!--                                </div>-->
<!--                                <div class="close-icon">-->
<!--                                    <i class="fas fa-times"></i>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="todo-add__card">-->
<!--                                <div class="add-icon">-->
<!--                                    <i class="fas fa-plus"></i>-->
<!--                                </div>-->
<!--                                <p>Add a card</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="todo-cards__wrapper">-->
<!--                    <div class="todo-cards__card">-->
<!--                        <div class="todo-cards__card-header">-->
<!--                            <div class="todo-box__item" data-state="editable">-->
<!--                                <div class="todo-box__item-text" contenteditable="true">-->
<!--                                    Blocked-->
<!--                                </div>-->
<!--                                <div class="close-icon">-->
<!--                                    <i class="fas fa-times"></i>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="todo-add__card">-->
<!--                                <div class="add-icon">-->
<!--                                    <i class="fas fa-plus"></i>-->
<!--                                </div>-->
<!--                                <p>Add a card</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="todo-cards__wrapper">-->
<!--                    <div class="todo-cards__card">-->
<!--                        <div class="todo-cards__card-header">-->
<!--                            <div class="todo-box__item" data-state="editable">-->
<!--                                <div class="todo-box__item-text" contenteditable="true">-->
<!--                                    Done-->
<!--                                </div>-->
<!--                                <div class="close-icon">-->
<!--                                    <i class="fas fa-times"></i>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="todo-add__card">-->
<!--                                <div class="add-icon">-->
<!--                                    <i class="fas fa-plus"></i>-->
<!--                                </div>-->
<!--                                <p>Add a card</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="todo-cards__wrapper">-->
<!--                    <div class="todo-cards__card todo-header__list">-->
<!--                        <div class="todo-cards__card-header">-->
<!--                            <div class="todo-add__card">-->
<!--                                <div class="add-icon">-->
<!--                                    <i class="fas fa-plus"></i>-->
<!--                                </div>-->
<!--                                <p>Add a card</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </section>-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--    import draggable from 'vuedraggable'-->
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
<!--        data() {-->
<!--            return {-->
<!--                list: message.map((name, index) => {-->
<!--                    return { name, order: index + 1, fixed: false };-->
<!--                }),-->
<!--                list2: [],-->
<!--                editable: true,-->
<!--                isDragging: false,-->
<!--                delayedDragging: false-->
<!--            };-->
<!--        },-->
<!--        components: {-->
<!--            draggable,-->
<!--        },-->
<!--        mounted() {-->
<!--            console.log('Component mounted.', this.list)-->
<!--        },-->
<!--        methods: {-->
<!--            clone({ name }) {-->
<!--                return { name, id: idGlobal++ };-->
<!--            },-->
<!--            pullFunction() {-->
<!--                return this.controlOnStart ? "clone" : true;-->
<!--            },-->
<!--            start({ originalEvent }) {-->
<!--                this.controlOnStart = originalEvent.ctrlKey;-->
<!--            }-->
<!--        }-->
<!--    }-->
<!--</script>-->
