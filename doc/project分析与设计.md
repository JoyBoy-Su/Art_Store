# Project分析与设计

## 一、页面分析

网站需要以下几个界面：

主页（进行艺术品展示，同时可以通过搜索查找商品）、登录、注册、搜索得到商品界面、艺术品详情页、个人中心、购物车界面、艺术品发布界面；逐个设计如下：

### 1、主页

主页的界面设计参考mi官方网站：

- 最顶部为简洁的导航栏，左侧为logo和**一段简要描述**，右侧操作栏登录前只包括主页、登录、注册的操作与购物车，登录后将登录|注册改为用户信息的下拉框；

- 顶部以下是主页的操作导航，包括：**首页、发布艺术品与个人中心**三项操作，三项后跟着的是搜索框进行搜索操作实现；布局见

    ![](img/top.png)

- 操作导航下为轮播图，效果参考![](img/rotation.png)（把左侧的链接导航更改为box也可以删除)，右侧课程表删除，img从背景图片改为div插入进行轮播
- 轮播图下为热门艺术品展示，效果如下：![](img/hot.png)左侧精品推荐改为热门艺术品，右侧查看全部操作删掉；每个小格子里展示的是艺术品照片 + 名称 + 作者姓名 + 售价 + 访问量：即把照片改为艺术品照片，黑体字改为艺术品名称 + 作者；再下一行的高级展示成售价，右侧多少人在学习改为访问量xxx；需要增加样式：鼠标划过时增加动态效果；
- 热门艺术品下为最新发布，效果同上，在价格和访问量下添加一行为发布时间；
- 热门艺术品下面为footer，包括版权信息和一些基本介绍；

### 2、登录与注册

登录与注册界面相同，维持最顶部的基础导航栏，下面插入一张背景图片，然后用一个表单进行登录或注册的信息填写；

### 3、搜索得到的商品界面

- 最顶部的基本信息导航和头部的基本操作导航保持原状；
- 导航下面一行为：关键词：xxx + 搜索结果：效果如下：![](img/search.png)
- 下面分页展示搜索结果，每页的商品维持在两行，每行4个总计8个；艺术品展示的结果显示同上面热门艺术品，不需要发布时间；但同样需要划过时的特效，点击可以跳转到艺术品详情页
- 搜索结果下为分页的页码，需要实现一个分页器，通过ajax进行分页，可以点击某一页跳转到该页或者通过文本框输入页码跳转到指定页码
- 最下面维持版权信息等footer

### 4、艺术品详情页

顶部信息保持不变，下面为一个div，div内左侧为img，即艺术品图片，右侧为一个表格，在表格中展示艺术品信息；

- 包含 艺术品图片、名称、作者姓名、价格、访问量、是否已售出、发布日期、发布者用户名、详细（指年份、大小（长度与宽度）、时代、风格等至少4项） 等至少10或12 项信息。若有余力，除此之外也可展示其他可能用到且可展示的信息。
- 对于 为空值的数据项，需显示一定的替代信息，比如 “该作品没有发布者” “该作品没有简介内容”，而不应直接显示 null 或者将该项留空。

### 5、个人中心

效果如图<img src="img/profile.png"  />

需要展示以下内容

- **个人信息**：展示注册时所用的信息（用户名、邮箱、电话、地址）以及 账户余额 。个人信息不要求可维护，即无需添加修改各项信息（与密码）的功能。
- **充值功能**：用户可以对账户余额进行充值。 不用真的充钱。 详细需求如下：新注册的用户的初始余额为 0。在个人中心页面上点击 “充值余额” 按钮弹出一个 充值窗口 ，其中含有一定的文字说明、一个文本框与 “充值” 按钮。输入文本框填写充值金额，只允许正整数金额，对于不合法输入需有错误提示。点击 “充值” 后再弹出一个确认框，确认后对数据库信息进行更新，充值金额直接到账。
- **我的订单列表**：展示已成功下单（即已购买）的艺术品。详细需求如下：至少显示 订单编号、订单时间、艺术品名称、订单金额 信息（即结账下单时生成的订单信息）。点击艺术品名称可跳转至相应的详情页。
-  “我发布的艺术品”、“我卖出的艺术品”，详见 Part B；

### 6、购物车界面

效果如图：

![](img/cart.png)

需要展示一个个购物车商品，（不要求实现分页），需显示 艺术品缩略图、名称、作者姓名、价格、简介。

- 信息展示：**若艺术品被 抢先购买** ，即在用户A将该艺术品加入购物车后，用户B也将该艺术品加入购物车并直接结款，则需要在该艺术品旁显示 “**该艺术品已售出**”，并 提示用户从购物车中删除该艺术品（根据**艺术品的state状态判断是否已售出**，若已售出则提醒删除该艺术品） 。若艺术品的任何信息被更改，则需要在该艺术品旁显示 “该艺术品信息存在变动”。（每一个商品用一个状态码记录当前的状态，用户加入购物车时记录id号和状态号，后续如果艺术品信息被修改，会修改最新的状态码，但用户的购物车中保持旧的状态码，根据**状态码是否相同判断该商品是否在添加购物车后被修改过**）
- 结账/下单操作：在结账按钮上显示 总价 ，点击后 弹出确认框 ，**确认框中需显示 总价、账户余额、地址信息、电话**
    **信息 并具有确认、取消按钮**。点击确认后 若**账户余额充足** ，则将购物车中艺术品的**状态设置为“已售出”**，为 每件购买的艺术品
    生成一个 订单 （即记录艺术品名称、订单金额（即该艺术品售价）并生成订单编号与订单时间）， 清空购物车 ，并 扣款 。
    点击确认后 若**账户余额不足** ，则需显示相应提示，购买失败。点击确认后 若**结款的商品列表中存在已售出的艺术品** ，则需显示相应提示，购买失败。卖出艺术品时，**在减少购买者余额的同时， 若存在出售者，则出售者账户余额需增加相同数额。**
- 删除操作：删除按钮，从购物车中删除该艺术品。

### 7、发布/修改已发布艺术品

同一个界面进行发布与修改

## 二、需求分析

### 1、登录与注册

（1）登录，登录的逻辑为：用户输入用户名与密码（或邮箱与密码），**在前端用js进行检查**（`blur`时检查），若检查结果不通过，则在input后的span中提示用户名（或密码不合法，为空）；前端检查**通过后提交表单，后端查询数据库**，判断用户是否存在与密码是否正确，（判断经计算后的哈希值与数据库的哈希字段是否一致），如果不一致，则登录失败；如果登录成功，需要根据用户的信息生成一个token，token是自解释的无需存到数据库，将该token返回给客户端，客户端作为`cookie`存起来，以后每次发请求都会带着token，登录成功后前端存起来token，并跳转到；

（2）注册，注册的逻辑为：用户在前端输入用户名密码，电话邮箱，同时选择地址（select下拉框，这里需要php返回下拉框），前端需要检查信息的合法性，如限制密码的规范，通过校验后提交表单给后端，后端**先判断信息是否合法，能够注册**（用户名冲突的情况），通过校验后添加到数据库中，包括用户名`UserName`，哈希加盐后的密码`Password`，电话`Phone`与邮箱`Email`，以及地址信息`Address`字段；

token和password的加密和验证都卸载`encrypt.php`文件中；

用户登录token判断逻辑：

```php
/**
 * 用户权限类，用来生成token，存储token和确认token
 * 用户发起请求后，有两种请求：1、登录请求 2、其他请求
 * 1、登录请求：登录请求时查表，判断表中是否有token信息
 *    如果有旧的token，不管是否过期，都update成新的token和新的过期时间
 *    如果没有旧的token，就设置token及有效期
 *    调用setToken()方法设置新的token与有效期
 * 2、其他请求：其他请求时，先查token是否有效，
 *    如果传过来的token有效，则执行操作，并更新token的有效时间；
 *    更新token有效时间时，无需判断是否存在，直接update有效时间即可；
 *    如果token无效（不管是过期还是不存在），就返回失败重新登录
 *    调用checkToken()方法检查token是否有效，
 *    调用updateToken()方法为token设置新的有效时间
 */
```

### 2、主页

主页的逻辑从上到下：

（1）最顶层的`nav`显示：在登录前导航栏展示：主页，登录，注册，详情；在登录后展示主页，详情，购物车，登出；

逻辑实现：`nav`的静态页面只写一个空的标签，在加载页面前客户端向服务器请求页面，请求页面时把此时cookie中的token发到后端，后端根据token判断是否已登陆并返回对应的`nav`界面，响应的页面放在一个`nav`项中，内容为一个`html`页面的一部分（一个div，只是导航栏右侧部分的操作项），js在拿到页面后操作`dom`将页面插入到主页的`nav`空标签完成实现界面加载；

（2）热门艺术品`hot`展示（最新艺术品`new`展示）：在进入主页后，需要发请求获取当前最热门的十个艺术品展示在页面中；

逻辑实现：当进入`index`主页时，通过Ajax发请求得到当前最火的10个艺术品进行展示，注：此次请求无需鉴定权限，后端返回生成好的html页面。

（3）轮播图展示：进入主页后，需要发请求由后台随机生成五个艺术品并生成轮播图的html页面返回，前端得到响应后处理到页面中；

注：在将html插入原页面后，需要将轮播图与热门最新艺术品的展示盒子绑定上单击事件，点击盒子可以跳转到search界面，并传递id；

每次进入主页，如果处于登录状态则更新token；

### 3、艺术品详情

艺术品详情页面的逻辑如下：首先获得`nav`；

判断是否存在艺术品id（即是否是直接进入的详情界面而没有选择艺术品）

若存在id，则向服务器发请求，**根据`ArtID`获得该艺术品的详细信息展示到表格中**；同时该页面在搜索到艺术品详细信息后需要提供**添加到购物车**与**购买**的操作按钮（同样由后端返回按钮页面）；

若不存在id，则向服务器发请求，将商品分页（按热度排序），返回和首页一致的页面展示结构作为展示；

**添加到购物车**的逻辑：前端通过js为添加到购物车的按钮绑定单击事件，点击后触发事件`addToCart`，将请求发给服务器，参数包括艺术品的id（当前页面`url`），同时cookie中存储token把用户的信息带到服务器，服务器验证token信息得到`userid`，如果用户已登陆将`userid`与`artid`的匹配关系存入carts数据表；如果用户未登录则返回false，设置message为`login`，js得到响应让其去登陆。

购物车的逻辑绑定用户和艺术品，**二者之间是多对多的，需要用carts一个表来存储**。

### 4、搜索

搜索页的逻辑如下：首先获得`nav`；然后进入搜索页面，进入页面后：

判断是否存在keyword，如果存在，则查找所有艺术品，按照keyword对所有艺术品进行过滤（编辑距离求相似度，按相似度排序），返回前端传入的页码数据（刚进入页面是默认为1）；

如果不存在keyword则直接按id顺序返回生成的html页面（所有艺术品）；

艺术品的简介可能很长，在后端将该简介截断，只展示前30个字符，后面用...代替，将修改后的内容设置到html页面中。

关于分页：在**进入页面时**默认页码为1（如果后端返回符合条件为0个，则修改为0），总页码更新为返回的total计算得到的页码，总个数更新为返回的total；在**修改页码时**，发起请求重新获取艺术品列表，先删除之前的艺术品，再添加新的艺术品，分页信息无需改变（页码除外）；在**修改关键字时**，更新`url`参数，先重置当前页码，发请求获取新的艺术品信息，拿到数据后**设置`total`和`totalPage`**（如果total为0则把页码设置为0），删除原艺术品界面，添加新的艺术品界面；在**修改排序方式时**，重置当前页码，其余参数不更新，只发请求获取新的排序结果并展示。

可以考虑在后端用缓存的机制暂存过滤出来的数据，避免每次访问数据库，缓解数据库压力，每次搜索先看和缓存中的关键字是否一致，不一致则更新缓存；

### 5、购物车

购物车的逻辑如下：**进入购物车前发请求校验登录状态**，

确定登录后获取`nav`，然后获取用户信息，根据用户信息得到用户的购物车信息，包括每个艺术品的信息，总数等；根据这些信息分别生成购物车顶部页面与内部页面，同时查询每个艺术品的状态（state和version），以便得到tips。

以上为界面展示的逻辑，支付的逻辑如下，js处理用户的选择，并进行初次检查判断是否存在不能购买的商品；通过处理后把请求法到后端由`php`处理：再次判断是否存在不可购买的商品，如果存在则全部不支付；如果都可支付，则判断余额是否充足，充足的话则扣除余额，把此次支付的商品从购物车中删除，修改这些商品的状态，同时为每件商品生成一个订单，**订单的信息包括订单号，支付方id，发布方id，艺术品id，支付时间**；

购物车前端交互逻辑：

（1）查看商品详情/删除：点击每一项艺术品的查看详情应该要跳转到响应的查看详情位置，需要在`delete`和`detail`的点击div绑定一个点击事件，同时未div设置`cartID`或`artID`（删除为`cartID`，详情为`artID`），点击事件中，根据属性做出相应的响应。

（2）结算价格：通过`jQuery`操作复选框，复选框的改变时会通知结算栏进行数据更新。（不可取，change事件不触发）；

### 6、发布/修改艺术品

发布修改的逻辑如下：进入该页面前发请求校验登录状态，如果没有登录则跳转登录；确定登录后获取`nav`，同时绑定`nav`的搜索函数；

发布/修改界面应根据`url`参数的有无显示不同的状态，若无`url`参数，则展示艺术品发布界面，表单项内容为空的，待用户填写。整体布局参考购物车，属于上下结构；

表单项包括：艺术品名称，作者姓名，作品简介，年份与年代，流派，长宽，图片与价格；校验条件如下：

- 艺术品名称、作者姓名、作者简介的校验为不为空（作者姓名不限制在已有的artist中）
- 年份的校验为必须为整数，暂定范围为-2000 ~ 2000四千年；（**待改进**）
- 长宽的校验为正数，价格的校验为正整数；
- 年代、流派的信息必须从已有的年代和流派中选择（发请求获取list，设置`其他`选项）；
- 图片的校验为非空；

### 7、个人中心

个人中心的逻辑如下：**前端在进入profile之前发请求校验登录状态**，如果没有登录则打回去重新登录；

确定登录后获取`nav`，个人中心应该是一个整体的左右结构，左侧是用户信息，以及一些选项（我发布的、**我买入的**以及**我卖出的**，加粗的两者为）

