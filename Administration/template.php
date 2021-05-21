<style>
    .playoff-table * {
        box-sizing: border-box;
    }

    .playoff-table {
        font-family: sans-serif;
        font-size: 15px;
        line-height: 1.42857143;
        font-weight: 400;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        background-color: #f5f5f5;
    }

    .playoff-table .playoff-table-content {
        display: -webkit-flex;
        display: -ms-flexbox;
        display: -ms-flex;
        display: flex;
        padding: 20px;
    }

    .playoff-table .playoff-table-tour {
        display: -webkit-flex;
        display: -ms-flexbox;
        display: -ms-flex;
        display: flex;
        -webkit-align-items: center;
        -ms-align-items: center;
        align-items: center;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-justify-content: space-around;
        -ms-justify-content: space-around;
        justify-content: space-around;
        position: relative;
    }

    .playoff-table .playoff-table-pair {
        position: relative;
    }

    .playoff-table .playoff-table-pair:before {
        content: '';
        position: absolute;
        top: 27px;
        right: -12px;
        width: 12px;
        height: 1px;
        background-color: red;
    }

    .playoff-table .playoff-table-pair:after {
        content: '';
        position: absolute;
        width: 3px;
        height: 1000px;
        background-color: #f5f5f5;
        right: -12px;
        z-index: 1;
    }

    .playoff-table .playoff-table-pair:nth-child(even):after {
        top: 28px;
    }

    .playoff-table .playoff-table-pair:nth-child(odd):after {
        bottom: 28px;
    }

    .playoff-table .playoff-table-pair-style {
        border: 1px solid #cccccc;
        background-color: white;
        width: 160px;
        margin-bottom: 20px;
    }

    .playoff-table .playoff-table-group {
        padding-right: 11px;
        padding-left: 10px;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
        height: 100%;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: -ms-flex;
        display: flex;
        -webkit-align-items: center;
        -ms-align-items: center;
        align-items: center;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-justify-content: space-around;
        -ms-justify-content: space-around;
        justify-content: space-around;
    }

    .playoff-table .playoff-table-group .playoff-table-pair-style:last-child {
        margin-bottom: 0px;
    }

    .playoff-table .playoff-table-group:after {
        content: '';
        position: absolute;
        top: 28px;
        bottom: 29px;
        right: 0px;
        width: 1px;
        background-color: red;
    }

    .playoff-table .playoff-table-group:last-child {
        margin-bottom: 0;
    }

    .playoff-table .playoff-table-left-player,
    .playoff-table .playoff-table-right-player {
        min-height: 26px;
        padding: 3px 5px;
    }

    .playoff-table .playoff-table-left-player {
        border-bottom: 1px solid #cccccc;
    }

    .playoff-table .playoff-table-left-player:before {
        content: '';
        position: absolute;
        bottom: 27px;
        left: -12px;
        width: 12px;
        height: 1px;
        background-color: red;
    }

    .playoff-table .playoff-table-right-player {
        margin-top: -1px;
        border-top: 1px solid #cccccc;
    }

    .playoff-table .playoff-table-third-place {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        margin-top: 100px;
    }

    .playoff-table .playoff-table-third-place .playoff-table-left-player:before {
        display: none;
    }

    .playoff-table .playoff-table-tour:first-child .playoff-table-group {
        padding-left: 0;
    }

    .playoff-table .playoff-table-tour:first-child .playoff-table-left-player:before {
        display: none;
    }

    .playoff-table .playoff-table-tour:last-child .playoff-table-group:after {
        display: none;
    }

    .playoff-table .playoff-table-tour:last-child .playoff-table-pair:after,
    .playoff-table .playoff-table-tour:last-child .playoff-table-pair:before {
        display: none;
    }
</style>
<div class="playoff-table">
    <div class="playoff-table-content">

        <div class="playoff-table-tour">

            <div class="playoff-table-group">
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">1</div>
                    <div class="playoff-table-right-player">2</div>
                </div>
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">3</div>
                    <div class="playoff-table-right-player">4</div>
                </div>
            </div>

            <div class="playoff-table-group">
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">5</div>
                    <div class="playoff-table-right-player">6</div>
                </div>
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">7</div>
                    <div class="playoff-table-right-player">8</div>
                </div>
            </div>

        </div>

        <div class="playoff-table-tour">
            <div class="playoff-table-group">
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">1</div>
                    <div class="playoff-table-right-player">2</div>
                </div>
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">3</div>
                    <div class="playoff-table-right-player">4</div>
                </div>
            </div>
        </div>
        <div class="playoff-table-tour">
            <div class="playoff-table-group">
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">1</div>
                    <div class="playoff-table-right-player">2</div>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br>

<div class="playoff-table">
    <div class="playoff-table-content">
        <div class="playoff-table-tour">
            <div class="playoff-table-group">
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">1</div>
                    <div class="playoff-table-right-player">2</div>
                </div>
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">3</div>
                    <div class="playoff-table-right-player">4</div>
                </div>
            </div>
            <div class="playoff-table-group">
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">5</div>
                    <div class="playoff-table-right-player">6</div>
                </div>
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">7</div>
                    <div class="playoff-table-right-player">8</div>
                </div>
            </div>
            <div class="playoff-table-group">
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">9</div>
                    <div class="playoff-table-right-player">10</div>
                </div>
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">11</div>
                    <div class="playoff-table-right-player">12</div>
                </div>
            </div>
            <div class="playoff-table-group">
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">13</div>
                    <div class="playoff-table-right-player">14</div>
                </div>
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">15</div>
                    <div class="playoff-table-right-player">16</div>
                </div>
            </div>
        </div>
        <div class="playoff-table-tour">
            <div class="playoff-table-group">
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">1</div>
                    <div class="playoff-table-right-player">2</div>
                </div>
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">3</div>
                    <div class="playoff-table-right-player">4</div>
                </div>
            </div>
            <div class="playoff-table-group">
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">5</div>
                    <div class="playoff-table-right-player">6</div>
                </div>
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">7</div>
                    <div class="playoff-table-right-player">8</div>
                </div>
            </div>
        </div>
        <div class="playoff-table-tour">
            <div class="playoff-table-group">
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">1</div>
                    <div class="playoff-table-right-player">2</div>
                </div>
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">3</div>
                    <div class="playoff-table-right-player">4</div>
                </div>
            </div>
        </div>
        <div class="playoff-table-tour">
            <div class="playoff-table-group">
                <div class="playoff-table-pair playoff-table-pair-style">
                    <div class="playoff-table-left-player">1</div>
                    <div class="playoff-table-right-player">2</div>
                </div>
            </div>
        </div>
    </div>
</div>